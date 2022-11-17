

@extends('user.layouts.master')
@section('content')

    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3 col offset-3">Contact Us</span></h2>
        <div class="row">
            @if (session('contactSuccess'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i>{{session('contactSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-6 offset-3">
                <form action="{{route('user#contactData')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" placeholder=" Enter your Name">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="form-control" type="email" name="email" placeholder="Enter Your Email">
                    </div>
                    <div class="form-group">
                  <textarea name="message" id="" cols="30" rows="10" class="form-control" type="text"></textarea>
                    </div>
                    <button class="btn btn-danger text-white" type="submit">Send Message</button>
                </form>
            </div>

        </div>
    </div>
    <!-- Contact End -->
@endsection


