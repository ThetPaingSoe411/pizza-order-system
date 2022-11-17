@extends('admin.layouts.master')
@section('title','categorylistPage')
@section('content')
{{-- min content --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">
                            <a href="{{route('admin#productlist')}}">
                                <i class="fa-solid fa-arrow-left text-dark"></i></a>
                          </div>
                        <div class="card-title">

                            <h3 class="text-center title-2">Update Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                    <img src="{{asset('storage/'.$pizza->image)}}" alt="">

                                    <div class="mt-3">
                                        <input type="file" name="pizzaImage"class="form-control  @error('pizzaImage') is invaild @enderror">
                                        @error('pizzaImage')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary text-white mt-3 col-12"><i class="fa-solid fa-arrow-up-right-from-square me-2"></i>update</button>
                                    </div>
                                </div>
                                <div class="row col-6">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="pizzaName" type="text"value="{{old('pizzaName',$pizza->name)}}"
                                         class="form-control @error('pizzaName') is invaild @enderror" aria-required="true"
                                         aria-invalid="false" placeholder="Enter Name..">
                                         @error('pizzaName')
                                         <div class="text-danger">{{$message}}</div>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" class="form-control  @error('pizzaDescription') is invaild @enderror"
                                        id="" cols="30" rows="10">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                          @error('pizzaDescription')
                                          <div class="text-danger">{{$message}}</div>
                                          @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is invaild @enderror">
                                            <option value="">Choose Categories...</option>
                                            @foreach ( $category as $c)
                                            <option value="{{$c->eid}}" @if($pizza->category_id == $c->id)selected @endif>{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="pizzaPrice" type="number"value="{{old('pizzaPrice',$pizza->price)}}"                                         class="form-control" aria-required="true"
                                         aria-invalid="false"class="form-control @error('pizzaPrice') is invaild @enderror"
                                          placeholder="Enter price..">
                                          @error('pizzaPrice')
                                          <div class="text-danger">{{$message}}</div>
                                          @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Waiting Time</label>
                                        <input type="number"
                                        name="pizzaWaitingTime"class="form-control @error('pizzaWaitingTime') is invaild @enderror"
                                         id=""value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}">
                                        @error('pizzaWaitingTime')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">View Count</label>
                                        <input type="number" name=""class="form-control" id=""
                                        value="{{old('viewcount',$pizza->view_count)}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Created at</label>
                                        <input type="text" name=""class="form-control" id=""
                                        value="{{$pizza->created_at->format('j-F-Y')}}"disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- main content --}}
@endsection

