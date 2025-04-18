<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ledger;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Invoice;
use App\Models\User;


class LedgerController extends Controller
{
    public function ledger(Request $request)
    {
        $user = Auth::guard('user')->user();
        if(!$user)
        {
            return redirect()->back()->with('error','User Not Authenticated');
        }

        $start_date = $request->start_date ;
        $end_date = $request->end_date ; 
        $keyword = $request->keyword ?? '';

        $ledgers = Ledger::with('user')->where('user_id', $user->id);

        if ($start_date && $end_date) {
            $ledgers->whereBetween('created_at', [
                Carbon::parse($start_date)->startOfDay(),
                Carbon::parse($end_date)->endOfDay()
            ]);
        } elseif ($start_date) {
            $ledgers->where('created_at', '>=', Carbon::parse($start_date)->startOfDay());
        } elseif ($end_date) {
            $ledgers->where('created_at', '<=', Carbon::parse($end_date)->endOfDay());
        }        

        if($keyword)
        {
            $ledgers->where('transaction_id', 'like', '%'. $keyword . '%');
        }

        // $ledgers->when($keyword, function($query) use ($keyword){
        //     $query->where('transaction_id', 'like', '%'. $keyword . '%');
        // });

        // $ledgers = Ledger::with('user')
        // ->where('user_id',$user->id)
        // ->latest()
        // ->get();

        $ledgers = $ledgers->latest()->get();

        $totalCredit = $ledgers->where('is_credit', 1)->sum('transaction_amount');
        $totalDebit = $ledgers->where('is_debit', 1)->sum('transaction_amount');
        $balance = $totalCredit - $totalDebit;

        return view('ledger.ledger_show', compact('user','ledgers','totalCredit','totalDebit','balance'));
    }

    public function downloadPDF(Request $request)
    {
        $user = Auth::guard('user')->user();

        if(!$user){
            return redirect()->back()->with('error', 'User Not Authentication');
        }
        $start_date = $request->start_date ;
        $end_date = $request->end_date ; 
        $keyword = $request->keyword ?? '';

        $ledgers = Ledger::with('user')->where('user_id', $user->id);

        if ($start_date && $end_date) {
            $ledgers->whereBetween('created_at', [
                Carbon::parse($start_date)->startOfDay(),
                Carbon::parse($end_date)->endOfDay()
            ]);
        } elseif ($start_date) {
            $ledgers->where('created_at', '>=', Carbon::parse($start_date)->startOfDay());
        } elseif ($end_date) {
            $ledgers->where('created_at', '<=', Carbon::parse($end_date)->endOfDay());
        }        
        if($keyword)
        {
            $ledgers->where('transaction_id', 'like', '%'. $keyword . '%');
        }
        $ledgers = $ledgers->latest()->get();

        $totalCredit = $ledgers->where('is_credit', 1)->sum('transaction_amount');
        $totalDebit = $ledgers->where('is_debit', 1)->sum('transaction_amount');
        $balance = $totalCredit - $totalDebit;

        $pdf = Pdf::loadView('ledger.ledger_pdf', compact('user', 'ledgers', 'balance'));

        return $pdf->download('ledger_' . now()->format('Ymd') . '.pdf');   
    }

    public function allLedger(Request $request)
    {
        $admin = Auth::guard('web')->user(); 
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin Not Authenticated');
        }
    
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $keyword = $request->keyword ?? '';
    
        $ledgers = Ledger::with('user');
    
        if ($start_date && $end_date) {
            $ledgers->whereBetween('created_at', [
                Carbon::parse($start_date)->startOfDay(),
                Carbon::parse($end_date)->endOfDay()
            ]);
        } elseif ($start_date) {
            $ledgers->where('created_at', '>=', Carbon::parse($start_date)->startOfDay());
        } elseif ($end_date) {
            $ledgers->where('created_at', '<=', Carbon::parse($end_date)->endOfDay());
        }
    
        if ($keyword) {
            $ledgers->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        $totalCredit = (clone $ledgers)->where('is_credit', 1)->sum('transaction_amount');
        $totalDebit = (clone $ledgers)->where('is_debit', 1)->sum('transaction_amount');
        $balance = $totalCredit - $totalDebit;
    
        $customerNames = User::where('role', 'user')
            ->select('name')
            ->orderBy('name')
            ->distinct()
            ->pluck('name');

        $ledgers = $ledgers->latest('id')->paginate(25);
    
        return view('ledger.allLedger', compact(
            'start_date', 'end_date', 'keyword', 'ledgers',
            'totalCredit', 'totalDebit', 'balance', 'customerNames'
        ));
    }

    public function allLedgerDownload(Request $request)
    {
        $admin = Auth::guard('web')->user(); 
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin Not Authenticated');
        }
    
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $keyword = $request->keyword ?? '';
    
        $ledgers = Ledger::with('user');
    
        if ($start_date && $end_date) {
            $ledgers->whereBetween('created_at', [
                Carbon::parse($start_date)->startOfDay(),
                Carbon::parse($end_date)->endOfDay()
            ]);
        } elseif ($start_date) {
            $ledgers->where('created_at', '>=', Carbon::parse($start_date)->startOfDay());
        } elseif ($end_date) {
            $ledgers->where('created_at', '<=', Carbon::parse($end_date)->endOfDay());
        }
    
        if ($keyword) {
            $ledgers->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        $totalCredit = (clone $ledgers)->where('is_credit', 1)->sum('transaction_amount');
        $totalDebit = (clone $ledgers)->where('is_debit', 1)->sum('transaction_amount');
        $balance = $totalCredit - $totalDebit;
    
        $customerNames = User::where('role', 'user')
            ->select('name')
            ->orderBy('name')
            ->distinct()
            ->pluck('name');

        $ledgers = $ledgers->latest('id')->paginate(25);
    
        $pdf = Pdf::loadView('ledger.allLedgerDownload_pdf', compact('admin', 'ledgers', 'balance','totalCredit','totalDebit'));

        return $pdf->download('ledger_' . now()->format('Ymd') . '.pdf'); 
    }
}
