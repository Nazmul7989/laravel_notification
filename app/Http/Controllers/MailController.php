<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Notifications\SendCustomMail;
use App\Notifications\SendMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $user = User::find($request->id);
        $user->notify(new SendMail($user));

        return redirect()->back()->with('status','Email send successfully');
     }

     //Send Custom mail
     public function customMail(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $product = new Product();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->user_id = Auth::user()->id;
        $product->save();


        $user->notify(new SendCustomMail($user,$product ));

        return redirect()->back()->with('status','Email send successfully');
     }
}


