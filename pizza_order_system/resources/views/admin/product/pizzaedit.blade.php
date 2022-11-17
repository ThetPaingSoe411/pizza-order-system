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
                        <div class="ms-5">
                          <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Pizza Details</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-1">
                                <img src="{{asset('storage/'.$pizzas->image)}}" alt="">
                            </div>
                            <div class="col-7 offset-1">
                                <h3 class="my-2 btn btn-success d-block w-50">{{$pizzas->name}}</h3>
                                <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-money-bill me-2"></i>{{$pizzas->price}} ks</span>
                                <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-clock me-2"></i>{{$pizzas->waiting_time}}</span>
                                <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-eye me-2"></i>{{$pizzas->view_count}}</span>
                                <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-clone me-2"></i>{{$pizzas->category_name}}</span>
                                <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-calendar-days me-2"></i>{{$pizzas->created_at->format('j-F-Y')}}</span>

                                <div class="my-2"><i class="fa-solid fa-file-prescription me-2"></i>Details</div>
                                <div class="text-muted">{{$pizzas->description}}</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- main content --}}
@endsection

