<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;
use App\Models\Ledger;

class WalletController extends Controller
{
    public function walletView(){
        $user = Auth::guard('user')->user();

        if(!$user)
        {
            return redirect()->back()->with('error','User not Authenticated');
        }
        // $active_balance = Wallet::where('user_id', $user->id)->sum('wallet_balance');
        $wallets = Wallet::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        $totalBalance = $wallets->sum('wallet_balance');

        return view('wallet.wallet_view',compact('wallets','totalBalance'));
    }

    public function walletCreate()
    {
        return view('wallet.wallet_recharge');
    }

    public function walletStore(Request $request)
    {
        $request->validate([
        'amount' => 'required|numeric|min:1',
        ]);
        $fetchUser = Wallet::where('user_id', Auth::guard('user')->id())->first();
        if($fetchUser){
                $fetchUser->wallet_balance = $fetchUser->wallet_balance+$request->amount;
                $fetchUser->amount_added = $request->amount;
                $fetchUser->save();
        }else{
            $wallet = Wallet::create([
                'user_id' => Auth::guard('user')->id(),
                'wallet_balance' => $request->amount,
                'amount_added' => $request->amount,
                'created_at' => now(),
            ]);
        }
       
        Ledger::create([
            'user_id' => Auth::guard('user')->id(),
            'transaction_amount' => $request->amount,
            'is_credit' => 1,
            'is_debit' => 0,
            'purpose' => 'Wallet Recharge',
            'purpose_description' => 'User added money to wallet',
        ]);
        
        return redirect()->route('wallet.show')->with('success', 'Wallet recharged successfully!');
    }
}


