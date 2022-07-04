<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WalletRequest;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
	 public function createWallet()
    {
	    return view('create_wallet')
    }
    public function saveWallet(WalletRequest $request)
    {
	    Wallet::create([
		    'address'=>$request->address,
		    'user_id'=>Auth::user()->id
	    ])
	   return Redirect::route('create.wallet')->with('message', 'your wallet save successfully');
    }
}
