@extends('admin.layouts.master')
@section('title','categorylistPage')
@section('content')
{{-- min content --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-3 offset-3">
                        <form action="" method="get">
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
                    <button class="btn btn-success mt-2"><i class="fa-solid fa-message me-2 text-warning"></i>{{count($data)}}</button>
                </div>


                {{-- @if ($pizzas->count() != 0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Created_at</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($data as $d)
                        <tr>
                            <td>{{$d->id}}</td>
                            <td>{{$d->name}}</td>
                            <td>{{$d->message}}</td>
                            <td>{{$d->created_at->format('J-F-y')}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('admin#contactDelete',$d->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                      </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
{{-- main content --}}
@endsection



