<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function walletView(){
        $user = Auth::guard('user')->user();

        if(!$user)
        {
            return redirect()->back()->with('error','User not Authenticated');
        }

        $active_balance = Wallet::where('user_id', $user->id)->sum('wallet_balance');
        $wallet = Wallet::where('user_id', $user->id)->orderBy('id', 'DESC')->get();

        return view('wallet.wallet_view',compact('wallet','active_balance'));
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
        
        $wallet = Wallet::firstOrCreate(
        ['user_id' => Auth::guard('user')->id()],
        ['wallet_balance' => 0]
        );
        
        $wallet->wallet_balance += $request->amount;
        $wallet->amount_added = $request->amount;
        $wallet->created_at = now();
        $wallet->save();
        
        return redirect()->route('wallet.show')->with('success', 'Wallet recharged successfully!');
    }
}


