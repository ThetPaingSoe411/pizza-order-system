@extends('admin.layouts.master')
@section('title','categorylistPage')
@section('content')
{{-- min content --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">

                <div class="table-responsive table-responsive-data2">
                    <a href="{{route('admin#orderList')}}" class="text-dark"><i class="fa-solid fa-arrow-circle-left"></i>back</a>

                    <div class="card mt-4 col-6">
                        <div class="card-body"style="border-bottom:1px solid black;">
                            <h3 class="text-muted"><i class="fa-solid fa-clipboard me-2"></i>Order Info </h3>
                            <small class="text-warning"><i class="fa-solid fa-triangle-exclamation"></i>Include delivery fees</small>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                <div class="col">{{strtoupper($orderList[0]->user_name)}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-code me-2"></i>Order Code</div>
                                    <div class="col">{{$orderList[0]->order_code}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-calendar-days me-2"></i>Order Date</div>
                                    <div class="col">{{$orderList[0]->created_at->format('j-F-y')}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-money-bill-wave me-2"></i>Total Price</div>
                                    <div class="col">{{$order->total_price}} kyats</div>
                                </div>
                            </div>
                        </div>
                    <table class="table table-data2">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Order ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Order Date</th>
                            <th>Qty</th>
                            <th>Amount</th>


                        </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($orderList as $o)
                        <tr class="tr-shadow my-1">
                            <td></td>
                            <td class="">{{$o->id}}</td>
                            <td class="col-2"><img src="{{asset('storage/'.$o->product_image)}}" class="img-thumbnail"></td>
                            <td class="">{{$o->product_name}}</td>
                            <td class="">{{$o->created_at->format('j-F-y')}}</td>
                            <td class="">{{$o->total}}</td>
                            <td class="">{{$o->qty}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{-- {{$order->links()}} --}}
                </div>
                {{-- @else
                <h3 class="text-secondary text-center mt-5">There is No Pizzas Here!</h3>
                @endif --}}

            </div>
        </div>
    </div>
</div>
</div>
{{-- main content --}}
@endsection
@section('scriptSection')

@endsection

