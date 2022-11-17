<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //password change page
public function changePasswordPage(){
    return view('admin.account.changePassword');
    }
    //change Password
    public function changePassword(Request $request){
    $this->passwordValidationCheck($request);
    $currentUserId=Auth::user()->id;
    $user=User::select('password')->where('id',$currentUserId)->first();
    $dbHashValue =$user->password;

    if(Hash::check($request->oldPassword, $dbHashValue)){
    $data=[
        'password'=>Hash::make($request->newPassword)
    ];
    User::where('id',Auth::user()->id)->update($data);
    return back()->with(['changeSuccess'=>'password changed..']);
    }
    return back()->with(['notMatch'=>'The old password not Match.Try Again!']);
    }

///direct account details
public function details(){
return view('admin.account.details');
}
//direct account profile edit
public function profile(){
return view('admin.account.edit');
}
//-----------------------------------------------------------------------------------------------------
//update account
// public function update($id,Request $request){
// $this->accountValidationCheck($request);
// $data=$this->getUserData($request);

// //for image
// if($request->hasFile('image')){
// //old image name/check=>delete:  store
// $dbImage =User::where('id',$id)->first();
// $dbImage=$dbImage->image;

// if($dbImage != null){
// Storage::delete('public/'.$dbImage);
// }
// $fileName=uniqid().$request->file('image')->getClientOriginalName();
// $request->file('image')->storeAs('public',$fileName);
// $data['image']=$fileName;
// }
// User::where('id',$id)->update($data);
// return redirect()->route('admin#details')->with(['updateSucess'=>'updated data..']);
// }
public function update($id,Request $request){
$this->accountValidationCheck($request);
$data=$this->getUserData($request);

if($request->hasFile('image')){
$dbImage=User::where('id',$id)->first();
$dbImage=$dbImage->image;

if($dbImage != null){
Storage::delete('public/'.$dbImage);
}
$fileName=uniqid().$request->file('image')->getClientOriginalName();
$request->file('image')->storeAs('public',$fileName);
$data['image']=$fileName;
}
User::where('id',$id)->update($data);
return redirect()->route('admin#details')->with(['updateSuccess'=>'update Success...']);
}
//--------------------------------------------------------------------------------------------------------------------
//adminlist
public function adminlist(){
$admin=User::when(request('key'),function($query){
$query->orWhere('name','like','%'.request('key').'%')
->orWhere('email','like','%'.request('key').'%')
->orWhere('gender','like','%'.request('key').'%')
->orWhere('phone','like','%'.request('key').'%')
->orWhere('address','like','%'.request('key').'%');
})
->where('role','admin')->paginate(3);
$admin->appends(request()->all());
return view('admin.account.list',compact('admin'));
}

//admin delete account
public function admindelete($id){
User::where('id',$id)->delete();
return back()->with(['deleteSuccess'=>'delete success..']);
}

//admin user change role
public function changeRole($id){
$account=User::where('id',$id)->first();
return view('admin.account.changeRole',compact('account'));
}
//admin change
public function change($id,Request $request){
$data=$this->requestUserData($request);
User::where('id',$id)->update($data);
return redirect()->route('admin#list');
}
//request user data for role change
private function requestUserData($request){
return [
'role'=>$request->role
];
}
//user data
private function getUserData($request){
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
