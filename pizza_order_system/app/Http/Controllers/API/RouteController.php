<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products=Product::get();
        $users=User::get();
        $data=[
            'product'=>$products,
            'user'=> $users
        ];
        return response()->json($data,200);
    }

    //get category list
    Public function categoryList(){
        $category=Category::get();
        return response()->json($category,200);
    }
    Public function orderCart(){
        $cart =Cart::get();
        $order=Order::get();
        $contact=Contact::get();
        $data=[
            'cart'=>$cart,
            'order'=>$order,
            'contact'=>$contact
        ];
        return response()->json($data,200);
    }
    public function categorycreate(Request $request){
        $data=[
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        $response = Category::create($data);
        return response()->json($response,200);
    }
    public function createContact(Request $request){
        $data=[
            "name"=>$request->name,
            "email"=>$request->email,
            "message"=>$request->message,
            "created_at"=>Carbon::now(),
            "updated_at"=>Carbon::now()
        ];
        $response=Contact::create($data);
        return response()->json($response,200);
    }
//delete data
    public function deleteCategory($id){
        $data=Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status' => true ,'message'=>$id],200);
        }
        return response()->json(['status'=>false,'message'=>'there is no category here...'],200);
    }
    //get category details
    public function categoryDetails($id){
        $data=Category::where('id',$id)->first();
        if(isset($data)){
            return response()->json(['status'=>true,'category'=>$data],200);
        }
        return response()->json(['status'=>false,'category'=>'There is no category...'],200);
    }


     //update category
     public function categoryUpdate(Request $request){
        $categoryId = $request->category_id;
        $dbSource=Category::where('id',$categoryId)->first();
        if(isset($dbSource)){
            $data=$this->getCategoryData($request);
            $response = Category::where('id',$categoryId)->update($data);
            return response()->json(['status'=>true,'message'=>'category update success...','category'=>$response],200);
        }
        return response()->json(['status'=>false,'message'=>'There is no category for update...'],500);
     }


     //get category data
     private function getCategoryData($request){
        return[
            'name'=>$request->category_name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
     }
}

