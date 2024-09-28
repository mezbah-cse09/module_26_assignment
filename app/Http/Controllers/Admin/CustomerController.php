<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    function AdminCustomerPage(){
        return view('pages.admin.customer-page');
    }

    function CustomerCreate(Request $request){

        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
        ]);
    }

    function CustomerDelete(Request $request){
        $customer_id = $request->input('id');
        return User::where('id',$customer_id)->delete();
    }

    function CustomerById(Request $request){
        $customer_id = $request->input('id');
        return User::where('id',$customer_id)->first();
    }

    function CustomerList(Request $request){
        $id = $request->header('id');
        return User::whereNot('id',$id)->get();
    }

    function CustomerUpdate(Request $request){
        $customer_id = $request->input('id');
        return User::where('id',$customer_id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
        ]);
    }

}
