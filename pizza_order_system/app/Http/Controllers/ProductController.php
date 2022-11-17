<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
    //direct product list page
public function productlist(){
$pizzas=Product::select('products.*','categories.name as category_name')
->when(request('key'),function($query){
$query->where('products.name','like','%'.request('key').'%');
})
->leftJoin('categories','products.category_id','categories.id')
->orderBy('products.created_at','desc')->paginate(3);
$pizzas->appends(request()->all());
return view('admin.product.pizzalist',compact('pizzas'));
}
//direct create page
public function productCreate(){
$categories=Category::select('id','name')->get();
return view('admin.product.pizzacreate',compact('categories'));
}
//delete pizza
public function delete($id){
Product::where('id',$id)->delete();
return redirect()->route('admin#productlist')->with(['deleteSuccess' => 'product delete..']);
}
//create product
public function create(Request $request){
$this->productValidationCheck($request,'create');
$data=$this->requestProductInfo($request);

$fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
$request->file('pizzaImage')->storeAs('public',$fileName);
$data['image']=$fileName;

Product::create($data);
return redirect()->route('admin#productlist');
}
//edit pizza
public function edit($id){
$pizzas=Product::select('products.*','categories.name as category_name')
->where('products.id',$id)
->leftJoin('categories','products.category_id','categories.id')
->first();
return view('admin.product.pizzaedit',compact('pizzas'));
}

//update redirect pizzaPage
public function updatePage($id){
$pizza =Product::where('id',$id)->first();
$category=Category::get();
return view('admin.product.pizzaUpdate',compact('pizza','category'));
}
//update pizza
public function update(Request $request){
$this->productValidationCheck($request,'update');
$data=$this->requestProductInfo($request);

if($request->hasFile('pizzaImage')){
$oldImageName=Product::where('id',$request->pizzaId)->first();
$oldImageName=$oldImageName->image;

if($oldImageName != null){
Storage::delete('public/'.$oldImageName);
}
$fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
$request->file('pizzaImage')->storeAS('public',$fileName);
$data['image']=$fileName;
}
Product::where('id',$request->pizzaId)->update($data);
return redirect()->route('admin#productlist');
}
//product data request
private function requestProductInfo($request){
return[
'category_id'=>$request->pizzaCategory,
'name'=>$request->pizzaName,
'description'=>$request->pizzaDescription,
'price'=>$request->pizzaPrice,
'waiting_time'=>$request->pizzaWaitingTime
];
}
//product validation check
private function productValidationCheck($request,$action){
$validationRules=[
    'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
    'pizzaCategory'=>'required',
    'pizzaDescription'=>'required|min:10',
    'pizzaPrice'=>'required',
    'pizzaWaitingTime'=>'required'
];
$validationRules['pizzaImage']=$action=='create'? 'required|mimes:jpg,jpeg,png,webp|file':'mimes:jpg,jpeg,png,webp|file';
Validator::make($request->all(),$validationRules)->validate();
}
}
