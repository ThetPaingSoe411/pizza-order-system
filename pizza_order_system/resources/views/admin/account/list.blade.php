@extends('admin.layouts.master')
@section('title','categorylistPage')
@section('content')
{{-- min content --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                </div>
                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-trash me-2"></i>{{session('deleteSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-3">
                        <h5 class="text-secondary">Search Key: <span class="text-danger">{{request('key')}}</span></h5>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{route('admin#list')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control"placeholder="search..."value="{{request('key')}}">
                                <button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-2 offset-10">
                    <button class="btn btn-success mt-2"><i class="fa-solid fa-database me-2 text-warning"></i>{{$admin->total()}}</button>
                </div>

                <div class="table-responsive table-responsive-data2">
    <table class="table table-data2">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Address</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admin as $a)
            <tr class="tr-shadow my-1">
                <td class="col-2">
                    @if ($a->image != null)
                    <img src="{{asset('storage/'.$a->image)}}" alt="" class="img-thumbnail shadow-sm">
                    @else
                    @if ($a->gender =='male')
                    <img src="{{asset('image/default male.png')}}" alt=""class="img-thumbnail shadow-sm" >
                    @else
                    <img src="{{asset('image/default female.png')}}" alt="" class="img-thumbnail shadow-sm" >
                    @endif
                    @endif
                </td>
                <td>{{$a->name}}</td>
                <td>{{$a->email}}</td>
                <td>{{$a->gender}}</td>
                <td>{{$a->phone}}</td>
                <td>{{$a->address}}</td>
                <td>
                    <div class="table-data-feature">
                        @if (Auth::user()->id == $a->id)
                        @else
                        <a href="{{route('admin#changeRole',$a->id)}}">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="changeRole">
                                <i class="fa-solid fa-person-circle-minus"></i>
                            </button>
                        </a>
                        <a href="{{route('admin#delete',$a->id)}}">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                        </a>
                    @endif

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div class="">
{{$admin->links()}}
{{-- {{$categories->appends(request()->query())->links()}} --}}
</div>
</div>
{{-- @else --}}


{{-- @endif --}}
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
{{-- main content --}}
@endsection

