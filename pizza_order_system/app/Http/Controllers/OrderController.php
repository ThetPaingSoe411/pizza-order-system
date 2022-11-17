<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page
    public function orderList(){
        $order=Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->when(request('key'),function($query){
            $query->orWhere('orders.status','like','%'.request('key').'%')
           ->orWhere('orders.order_code','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc')
        ->paginate(5);
        return view('admin.order.list',compact('order'));
    }
    //sort ajax status
    public function changeStatus(Request $request){
        // $request->status=$request->status==null ? "":$request->status;
        //->orWhere('orders.status',$request->status)
        $order=Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc');
        if($request->orderStatus == null){
            $order = $order->get();
        }else{
           $order = $order->where('orders.status',$request->orderStatus)->get();
        }
        return view('admin.order.list',compact('order'));
    }


    //order list
    public function listInfo($orderCode){
        $order=Order::where('order_code',$orderCode)->first();
        $orderList=orderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->where('order_code',$orderCode)
        ->get();
        return view('admin.order.productlist',compact('orderList','order'));
    }



    public function ajaxChangeStatus(Request $request){
        logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status'=>$request->status
        ]);
        $order=Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')->get();
    }

}
