@extends('admin.layouts.master')
@section('title','categorylistPage')
@section('content')
{{-- min content --}}
<div class="main-content">
<div class="row">
<div class="col-4 offset-7 mb-2">
    @if (session('updateSucess'))
    <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check me-2"></i>{{session('updateSucess')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
    @endif
</div>
</div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-1">
                                @if (Auth::user()->image == null)
                                @if (Auth::user()->gender == 'male')
                                <img src="{{asset('image/default male.png')}}" alt=""class="img-thumbnail w-75">
                                @else
                                <img src="{{asset('image/default female.png')}}" alt=""class="img-thumbnail w-75">
                                @endif
                                @else
                                <img src="{{asset('storage/'.Auth::user()->image)}}" alt=""class="img-thumbnail">
                                @endif
                            </div>
                            <div class="col-6 offset-1">
                                <h5 class="my-2 mt-0"><i class="fa-solid fa-user me-2 text-primary"></i>{{Auth::user()->name}}</h5>
                                <h5 class="my-2"><i class="fa-solid fa-envelope me-2 text-primary "></i>{{Auth::user()->email}}</h5>
                                <h5 class="my-2"><i class="fa-solid fa-phone me-2 text-primary"></i>{{Auth::user()->phone}}</h5>
                                <h5 class="my-2"><i class="fa-solid fa-location-dot me-2 text-primary"></i>{{Auth::user()->address}}</h5>
                                <h5 class="my-2"><i class="fa-solid fa-calendar-days me-2 text-primary"></i>{{Auth::user()->created_at->format('j-F-Y')}}</h5>
                                <h5 class="my-2"><i class="fa-solid fa-venus-mars me-2 text-primary"></i>{{Auth::user()->gender}}</h5>
                            </div>
                        </div>
                        <div class="row text-center mt-2">
                            <a href="{{route('admin#profile')}}">
                                <div class="col-3 offset-1">
                                <button class="btn btn-danger text-white"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</button>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- main content --}}
@endsection

