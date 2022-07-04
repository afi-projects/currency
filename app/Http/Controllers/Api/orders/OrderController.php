<?php

namespace App\Http\Controllers\Api\orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\orderRequest;
use Illuminate\Http\Response;
use App\Http\Resources\orderResource;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\Currency;

class OrderController extends Controller
{


    public function save_order(OrderRequest $request)
    {
        $currency=Currency::find($request->currency_id);
        $user=User::find($request->user_id);
               DB::beginTransaction();
        try{
	         $wallet=Db::table('wallets')->where('user_id',$user->id)->sharedLock()->first();
             $amount=$request->amount;
             $total=bcadd($amount,bcmul($currency->fee / 100), $amount));
//         check user wallet
        if($wallet->balance < $total)
            return response('your wallet balance is not enough', 404)
                  ->header('Content-Type', 'text/plain');
        else
        {
	    $final_amount=bcsub($wallet->balance,$total);
        DB::table('wallets')
        ->where('user_id',$user->id)
        ->update(['balance' =>$final_amount ]);
        DB::table('orders')
        ->insert([
        'user_id'=>$user->id,
        'currency_id'=>$currency->id,
        'amount'=>$amount,
        'fee'=>$currency->fee ]);
         } 
	             DB::commit();
        }          
     } catch (\Exception $e) {
        DB::rollback();
    }
        return new orderResource($order);
    }
	
}
