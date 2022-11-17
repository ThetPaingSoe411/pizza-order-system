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
                        <a href="{{route('admin#list')}}">
                            <div class="text-dark">
                                <i class="fa fa-arrow-circle-left"></i></div>
                        </a>
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#change',$account->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if ($account->image == null)
                                    @if ($account->gender == 'male')
                                    <img src="{{asset('image/default male.png')}}" alt=""class="img-thumbnail w-75">
                                    @else
                                    <img src="{{asset('image/default female.png')}}" alt=""class="img-thumbnail w-75">
                                    @endif
                                    @else
                                    <img src="{{asset('storage/'.$account->image)}}" alt=""class="img-thumbnail w-75">
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" name="image"class="form-control  @error('image') is invaild @enderror"disabled>
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
                                        <input id="cc-pament" name="name" type="text"value="{{old('name',$account->name)}}"
                                         class="form-control @error('name') is invaild @enderror" aria-required="true"
                                         aria-invalid="false" placeholder="Enter Name.."disabled>
                                         @error('name')
                                         <div class="text-danger">{{$message}}</div>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <select name="role" id=""value="" class="form-control">
                                            <option value="admin" @if ($account->role == 'admin')selected @endif>admin</option>
                                            <option value="user" @if ($account->role == 'user')selected @endif>user</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="text"value="{{old('email',$account->email)}}"                                         class="form-control" aria-required="true"
                                         aria-invalid="false"class="form-control @error('email') is invaild @enderror"
                                          placeholder="Enter email.." disabled>
                                          @error('email')
                                          <div class="text-danger">{{$message}}</div>
                                          @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="text"value="{{old('phone',$account->phone)}}"
                                         class="form-control @error('phone') is invaild @enderror" aria-required="true"
                                         aria-invalid="false" placeholder="Enter phone.." disabled>
                                         @error('phone')
                                         <div class="text-danger">{{$message}}</div>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" id="" class="form-control @error('gender') is invaild @enderror" disabled>
                                            <option value="">Choose Gender...</option>
                                            <option value="male" @if ($account->gender == 'male')selected @endif>Male</option>
                                            <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                      <input type="text" name="address" id=""disabled class="form-control" placeholder="enter address.."value="{{$account->address}}">
                                        @error('address')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
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

