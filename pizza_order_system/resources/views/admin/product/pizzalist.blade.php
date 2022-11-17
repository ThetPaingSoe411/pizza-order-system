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
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('admin#productCreate')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                        <form action="{{route('admin#productlist')}}" method="get">
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
                    <button class="btn btn-success mt-2"><i class="fa-solid fa-database me-2 text-warning"></i>{{$pizzas->total()}}</button>
                </div>
                @if ($pizzas->count() != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>View Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pizzas as $p)
                        <tr class="tr-shadow my-1">
                            <td class="col-3"><img src="{{asset('storage/'.$p->image)}}" class="img-thumbnail shadow-sm"></td>
                            <td class="col-3">{{$p->name}}</td>
                            <td class="col-2">{{$p->price}}</td>
                            <td class=" col-2">{{$p->category_name}}</td>
                            <td class="col-1"><i class="fa-solid fa-eye me-1"></i>{{$p->view_count}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('product#edit',$p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="view">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('product#updatePage',$p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('product#delete',$p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                      </a>
                                      <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                        <i class="zmdi zmdi-more"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$pizzas->links()}}
                </div>
                @else
                <h3 class="text-secondary text-center mt-5">There is No Pizzas Here!</h3>
                @endif

            </div>
        </div>
    </div>
</div>
</div>
{{-- main content --}}
@endsection

