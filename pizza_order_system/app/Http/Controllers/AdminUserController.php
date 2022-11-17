<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //direct user list page
    public function userList(){
        $users=User::where('role','user')->paginate(3);
        return view('admin.user.userlist',compact('users'));
    }
    //change User Role
    public function changeRole(Request $request){
        $updateSource=[
            'role'=>$request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
    }
    //admin list page
    public function adminList(){
        $admins=User::where('role','admin')->paginate(3);
        return view('admin.user.adminlisst',compact('admins'));
    }
    //admin delete
    public function adminDelete($id){
     $data = User::where('id',$id)->delete();
        return redirect()->route('admin#adminList');
    }
    //user delete
    public function userDelete($id){
        $dataDelete=User::where('id',$id)->delete();
        return redirect()->route('admin#userList');
    }
  //change User Role
  public function adminChangeRole(Request $request){
    $updateSource=[
        'role'=>$request->role
    ];
    User::where('id',$request->adminId)->update($updateSource);
}
}
