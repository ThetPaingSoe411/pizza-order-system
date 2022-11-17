@extends('admin.layouts.master')
@section('title','categorylistPage')
@section('content')
{{-- min content --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->

                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-trash me-2"></i>{{session('deleteSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-6">
                        <form action="{{route('admin#changeStatus')}}"method="get">
                            @csrf
                            <div class="input-group mb-3">

                                <select name="orderStatus" class="form-control">
                                <option value="">All</option>
                                <option value="0"@if (request('orderStatus')==' 0') selected @endif>Pending</option>
                                <option value="1" @if (request('orderStatus')== '1') selected @endif>Success</option>
                                <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                            </select>
                             <button class="btn btn-sm bg-dark text-white"type="submit"><i class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                        </div>
                        </form>

                    </div>
                    <div class="col-3 offset-3">
                        <form action="{{route('admin#orderList')}}" method="get">
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
                    <button class="btn btn-success mt-2"><i class="fa-solid fa-database me-2 text-warning"></i>{{count($order)}}</button>
                </div>


                {{-- @if ($pizzas->count() != 0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Order Date</th>
                            <th>Order Code</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($order as $o)
                        <tr class="tr-shadow my-1">
                            <input type="hidden" value="{{$o->id}}"class="orderId">
                            <td class="">{{$o->user_id}}</td>
                            <td class="">{{$o->user_name}}</td>
                            <td class="">{{$o->created_at->format('j-F-y')}}</td>
                            <td class="">
                                <a href="{{route('admin#listInfo',$o->order_code)}}" class="text-primary">{{$o->order_code}}</a>
                            </td>
                            <td class="">{{$o->total_price}} kyats</td>
                            <td class="">
                                <select name="status" class="form-control" id="statusChange">
                                    <option value="0"@if ($o->status == 0) selected  @endif>Pending</option>
                                    <option value="1"@if ($o->status == 1) selected  @endif >Accept</option>
                                    <option value="2"@if ($o->status == 2) selected  @endif>Reject</option>
                                </select>
                            </td>
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
<script>
$(document).ready(function(){
    $('#statusChange').change(function(){
        $currentStatus=$(this).val();
        $parentNode=$(this).parents('tr');
        $orderId=$parentNode.find('.orderId').val();
        $data={
            'orderId': $orderId,
            'status':$currentStatus
        };
        $.ajax({
            type:'get',
            url:'/order/ajax/change/status',
            data: $data ,
            dataType : 'json'})
    })

    })
</script>
@endsection

