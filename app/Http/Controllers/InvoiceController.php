<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use App\Models\InvoiceItem;
use App\Models\Wallet;
use App\Models\Ledger;


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
    
    // public function submitInvoice(Request $request)
    // {
    //     $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();
    //     if (!$user) {
    //         return redirect()->route('login')->withErrors('User not authenticated');
    //     }
    
    //     $totalAmount = 0;
    //     $totalQuantity = 0;
    
    //     foreach ($request->product_id as $index => $productId) {
    //         $quantity = $request->quantity[$index];
    //         $amount = $request->amount[$index];
    //         $totalAmount += $amount;
    //         $totalQuantity += $quantity;
    //     }

    //     // $wallet = Wallet::where('user_id', $user->id)->first();

    //     // if(!$wallet || $wallet->wallet_balance < $totalAmount) {
    //     //     return response()->json(['success' => false, 'message' => 'Enough balance required to buy this product']);
    //     // }

    //     $totalBalance = Wallet::where('user_id', $user->id)->sum('amount_added');

    //     if($totalBalance < $totalAmount)
    //     {
    //         return response()->json(['success' => false, 'message' => 'Enough balance required to buy this product']);
    //     }

    //     // $wallet->wallet_balance -= $totalAmount;
    //     // $wallet->save();
  
    //     $invoice = Invoice::create([
    //         'customer_id' => $user->id,
    //         'customer_name' => $user->name,
    //         'customer_email' => $user->email,
    //         'quantity' => $totalQuantity,
    //         'total_amount' => $totalAmount,
    //     ]);
    
    //     foreach ($request->product_id as $index => $productId) {
    //         $product = Product::find($productId);
    //         $piecePerAmount = $product ? $product->price:0;

    //         InvoiceItem::create([
    //             'invoice_id' => $invoice->id,
    //             'product_id' => $productId,
    //             'quantity' => $request->quantity[$index],
    //             'amount' => $request->amount[$index],
    //             'piece_per_amount' => $piecePerAmount,
    //         ]);
    //     }

    //     Ledger::create([
    //         'user_id' => $user->id,
    //         'transaction_id' => $invoice->id,
    //         'transaction_amount' => $totalAmount,
    //         'is_credit' => 0,
    //         'is_debit' => 1,
    //         'purpose' => 'Product Purchase',
    //         'purpose_description' => 'User purchased products via invoice #' . $invoice->id,
    //     ]);

    //     return response()->json(['success' => true, 'message' => 'Invoice submitted successfully.']);
    // }
    public function submitInvoice(Request $request)
    {
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

        // $totalBalance = Wallet::where('user_id', $user->id)->sum('wallet_balance');

        // if ($totalBalance < $totalAmount) {
        //     return response()->json(['success' => false, 'message' => 'Enough balance required to buy this product']);
        // }

        // $wallet->wallet_balance -= $totalAmount;
        // $wallet->save();

        $wallet = Wallet::where('user_id', $user->id)->first();

        if(!$wallet || $wallet->wallet_balance < $totalAmount) {
        return response()->json(['success' => false, 'message' => 'Insufficient balance, please recharge your balance']);
        }

        $wallet->wallet_balance -= $totalAmount;
        $wallet->save();

        DB::beginTransaction();
        try {
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

            DB::commit();

            Ledger::create([
                'user_id' => Auth::guard('user')->id(),
                'transaction_id' => $invoice->id,
                'transaction_amount' => $totalAmount,
                'is_credit' => 0,
                'is_debit' => 1,
                'purpose' => 'Product Purchase',
                'purpose_description' => 'User purchased products via invoice #' . $invoice->id,
            ]);
            

            return response()->json(['success' => true, 'message' => 'Invoice submitted successfully.']);

        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            \Log::error("Submit Invoice Failed: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Something went wrong while submitting the invoice.']);
        }
    }
}
