<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use DB;

class OrderController extends Controller
{
    public function allInvoices(Request $request)
    {
        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();
    
        if (!$user) {
            return redirect()->route('login')->withErrors(['update_error' => 'User not authenticated']);
        }
    
        $start_date = $request->start_date ;
        $end_date = $request->end_date;
        $keyword = $request->keyword ?? '';
    
        $invoices = Invoice::query();
        // dd($start_date,$end_date);
        if($start_date && $end_date){
            $invoices->whereBetween('created_at', [$start_date." 00:00:00",$end_date." 23:59:59"]);
        }elseif($start_date){
            $invoices->where('created_at', '>=', $start_date." 00:00:00");
        }elseif($end_date){
            $invoices->where('created_at', '>=', $end_date." 23:59:59");
        }

        $invoices->when($keyword, function ($query) use ($keyword) {
            $query->where('customer_name', 'like', '%' . $keyword . '%')
                  ->orWhere('customer_email', 'like', '%' . $keyword . '%');
        });

        $customerNames = Invoice::select('customer_name')
                ->distinct()
                ->orderBy('customer_name')
                ->pluck('customer_name');

        $totalAmount = $invoices->sum('total_amount');
    
        $data = $invoices->latest('id')->paginate(25);
    
        return view('invoice.AllInvoices', compact('data', 'user', 'start_date','end_date', 'keyword', 'totalAmount','customerNames'));
    }

    public function myOrders(Request $request)
    {
        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();

        if (!$user) {
            return redirect()->route('login')->with(['error' => 'User not authenticated']);
        }

        $orders = DB::table('invoices')
                ->join('invoice_items','invoice_id', '=', 'invoice_items.invoice_id')
                ->where('invoices.customer_id', $user->id)
                ->selectRaw('DATE(invoices.created_at) as order_date, SUM(invoice_items.quantity) as total_quantity, SUM(invoices.total_amount) as total_amount')
                ->groupBy('order_date')
                ->orderBy('order_date','desc')
                ->get();

        return view('invoice.my_orders', compact('orders'));
    }

    public function viewOrders($date)
    {
        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();

        if(!$user)
        {
            return redirect()->route('login')->with(['error' => 'User Not Authenticated']);
        }

        $queries = Invoice::where('customer_id', $user->id)->with(['items.product']);

        $orders = Invoice::where('customer_id', $user->id)
        ->whereDate('created_at', $date)
        ->with(['items.product'])
        ->latest()
        ->get();
    
        return view('invoice.view_orders',compact('queries','date','orders'));
    }
}
