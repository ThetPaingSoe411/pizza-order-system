<?php

namespace App\Http\Controllers\User;
use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
public function home(){
$pizzas=Product::orderBy('created_at','desc')->get();
$category=Category::get();
$cart=Cart::where('user_id',Auth::user()->id)->get();
$history=Order::where('user_id',Auth::user()->id)->get();
return view('user.main.home',compact('pizzas','category','cart','history'));
}

//password changePage
public function changePasswordPage(){
return view('user.password.change');
}
//password change
public function changePassword(Request $request){
    $this->passwordValidationCheck($request);
    $currentUserId=Auth::user()->id;
    $user=User::select('password')->where('id',$currentUserId)->first();
    $dbHashValue=$user->password;
    if(Hash::check($request->oldPassword, $dbHashValue)){
        $data=[
            'password'=>Hash::make($request->newPassword)
        ];
        User::where('id',Auth::user()->id)>update($data);
        return back()->with(['changeSuccess'=>'password changed..']);
    }
    return back()->with(['notMatch'=>'The old password not Match.Try Again!']);
}
//user account change page
public function accountChagePage(){
return view('user.layouts.profile.account');
}

//pizzafiter
public function filter($categoryId){
$pizzas=Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
$category=Category::get();
$cart=Cart::where('user_id',Auth::user()->id)->get();
$history=Order::where('user_id',Auth::user()->id)->get();
return view('user.main.home',compact('pizzas','category','cart','history'));
}
//user account change
public function accountChange($id,Request $request){
$this->accountValidationCheck($request);
$data=$this->accountUseData($request);
if($request->hasFile('image')){
$dbImage=User::where('id',$id)->first();
$dbImage=$dbImage->image;

if($dbImage != null){
Storage::delete('public'.$dbImage);
}
$fileName=uniqid().$request->file('image')->getClientOriginalName();
$request->file('image')->storeAs('public',$fileName);
$data['image']=$fileName;
}
User::where('id',$id)->update($data);
return back()->with(['updateSuccess'=>'User Update Success..']);
}

//pizza details
public function pizzaDetails($pizzaId){
$pizzas=Product::where('id',$pizzaId)->first();
$pizzaList=Product::get();
return view('user.main.details',compact('pizzas','pizzaList'));
}
//cart list
public function cartList(){
$cartList=Cart::select('carts.*','products.image as product_image','products.name as pizza_name','products.price as pizza_price')
->leftJoin('products','products.id','carts.product_id')
->where('carts.user_id',Auth::user()->id)->get();
$totalPrice =0;
foreach($cartList as $c){
$totalPrice += $c->pizza_price * $c->qty;
}
return view('user.main.cart',compact('cartList','totalPrice'));
}
//direct history page
public function history(){
$order=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
return view('user.main.history',compact('order'));
}
///direct user contact page
public function UserContactPage(){
$cart=Cart::where('user_id',Auth::user()->id)->get();
return view('user.contanct.contact',compact('cart'));
}
//user contact data
public function UserContactData(Request $request){
$cart=Cart::where('user_id',Auth::user()->id)->get();
$userData=$this->contactData($request);
Contact::create($userData);
return view('user.contanct.contact',compact('cart'))->with(['contactSuccess' =>'Thanks For Your Message..']);
}
//contact user data
private function contactData($request){
    return [
        'name'=>$request->name,
        'email'=>$request->email,
        'message'=>$request->message,
        'created_at'=>Carbon::now()
        ];
}
//user data
private function accountUseData($request){
    return[
    'name'=>$request->name,
    'email'=>$request->email,
    'phone'=>$request->phone,
    'gender'=>$request->gender,
    'address'=>$request->address,
    'created_at'=>Carbon::now()
    ];
}
//account validation check
private function accountValidationCheck($request){
    Validator::make($request->all(),[
    'name'=>'required',
    'email'=>'required',
    'phone'=>'required',
    'image'=>'mimes:png,jpg,webp|file',
    'gender'=>'required',
    'address'=>'required'
    ])->validate();
    }
    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
        'oldPassword'=>'required|min:6',
        'newPassword'=>'required|min:6|max:10',
        'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ],[
        'oldPassword.required'=>'old password field is needed to fill',
        'newPassword.required'=>'new password field is needed to fill',
        'confirmPassword.required'=>'confirm password field is needed to fill'
        ])->validate();
        }
}

