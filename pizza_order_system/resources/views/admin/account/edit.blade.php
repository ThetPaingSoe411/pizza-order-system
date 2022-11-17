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
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Profile</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                    <img src="{{asset('image/default male.png')}}" alt=""class="img-thumbnail w-75">
                                    @else
                                    <img src="{{asset('image/default female.png')}}" alt=""class="img-thumbnail w-75">
                                    @endif
                                    @else
                                    <img src="{{asset('storage/'.Auth::user()->image)}}" alt=""class="img-thumbnail w-75">
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" name="image"class="form-control  @error('email') is invaild @enderror">
                                        @error('image')
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
                                        <input id="cc-pament" name="name" type="text"value="{{old('name',Auth::user()->name)}}"
                                         class="form-control @error('name') is invaild @enderror" aria-required="true"
                                         aria-invalid="false" placeholder="Enter Name..">
                                         @error('name')
                                         <div class="text-danger">{{$message}}</div>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="text"value="{{old('email',Auth::user()->email)}}"                                         class="form-control" aria-required="true"
                                         aria-invalid="false"class="form-control @error('email') is invaild @enderror"
                                          placeholder="Enter email..">
                                          @error('email')
                                          <div class="text-danger">{{$message}}</div>
                                          @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="text"value="{{old('phone',Auth::user()->phone)}}"
                                         class="form-control @error('phone') is invaild @enderror" aria-required="true"
                                         aria-invalid="false" placeholder="Enter phone..">
                                         @error('phone')
                                         <div class="text-danger">{{$message}}</div>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" id="" class="form-control @error('gender') is invaild @enderror">
                                            <option value="">Choose Gender...</option>
                                            <option value="male" @if (Auth::user()->gender == 'male')selected @endif>Male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea name="address" id="" cols="30" rows="10"class="form-control @error('address') is invaild @enderror">
                                        {{old('address',Auth::user()->address)}}</textarea>
                                        @error('address')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" type="text"value="{{old('role',Auth::user()->role)}}"
                                         class="form-control" aria-required="true"
                                         aria-invalid="false" placeholder="Enter role.." disabled>
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

