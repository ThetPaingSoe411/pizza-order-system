<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //admin contact page
public function contactPage(){
$data=Contact::orderBy('created_at','desc')->get();
return view('admin.user.contact',compact('data'));
}
public function delete($id){
$contactdelete=Contact::where('id',$id)->delete();
return redirect()->route('admin#contactPage');
}
}
