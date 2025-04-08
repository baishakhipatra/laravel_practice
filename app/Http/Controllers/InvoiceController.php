<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use App\Models\InvoiceItem;


class InvoiceController extends Controller
{
    public function invoice()
    {
        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();

        if (!$user) {
            return redirect()->route('login')->withErrors('User not authenticated');
        }
        $users = User::find($user->id);
        if (!$users) {
            return redirect()->route('login')->withErrors('User not found');
        }
        $products = Product::all();
        return view('invoice.invoice',compact('products','users'));
    }

    public function invoiceStore(Request $request)
    {
        $request->validate([
            'product_name' => 'required|array',
            'product_name.*' => 'required|exists:products,id',
        ], [
            'product_name.*.required' => 'Please select a product for each row.',
            'product_name.*.exists' => 'Selected product does not exist.',
        ]);
    }

    public function submitInvoice(Request $request)
    {
        $request->validate([
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:1',
            'amount.*' => 'required|numeric|min:0',
        ]);
    
        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();
        if (!$user) {
            return redirect()->route('login')->withErrors('User not authenticated');
        }
    
        $totalAmount = 0;
        $totalQuantity = 0;
    
        foreach ($request->product_id as $index => $productId) {
            $quantity = $request->quantity[$index];
            $amount = $request->amount[$index];
            $totalAmount += $amount;
            $totalQuantity += $quantity;
        }
  
        $invoice = Invoice::create([
            'customer_id' => $user->id,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'quantity' => $totalQuantity,
            'total_amount' => $totalAmount,
        ]);
    
        foreach ($request->product_id as $index => $productId) {
            $product = Product::find($productId);
            $piecePerAmount = $product ? $product->price : 0;

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $productId,
                'quantity' => $request->quantity[$index],
                'amount' => $request->amount[$index],
                'piece_per_amount' => $piecePerAmount,
            ]);
        }
    
        return redirect()->route('invoice')->with('success', 'Invoice submitted successfully.');
    }
}
