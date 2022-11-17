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
                    <button class="btn btn-success mt-2"><i class="fa-solid fa-users me-2 text-warning"></i>{{$users->total()}}</button>
                </div>


                {{-- @if ($pizzas->count() != 0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($users as $u)
                        <tr>
                            <td class="col-2">
                                @if ($u->image != null)
                                <img src="{{asset('storage/'.$u->image)}}" alt="" class="img-thumbnail shadow-sm">
                                @else
                                @if ($u->gender =='male')
                                 <img src="{{asset('image/default male.png')}}" alt=""class="img-thumbnail shadow-sm" >
                                 @else
                                 <img src="{{asset('image/default female.png')}}" alt="" class="img-thumbnail shadow-sm" >
                                 @endif
                                 @endif
                            </td>
                            <input type="hidden" value="{{$u->id}}" id="userId">
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->gender}}</td>
                            <td>{{$u->phone}}</td>
                            <td>
                                <select name="" class="form-control changeStatus" id="">
                                    <option value="user" @if ($u->role == 'user') selected @endif>user</option>
                                    <option value="admin" @if($u->role == 'admin' ) selected @endif>admin</option>
                                </select>
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('admin#adminDelete',$u->id)}}">
                                        <button class="item" data-toggle="tooltip"
                                            data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$users->links()}}
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
$('.changeStatus').change(function(){
    $currentStatus=$(this).val();
    $parentNode=$(this).parents('tr');
    $userId=$parentNode.find('#userId').val();


    $data={
        'userId':$userId,
        'role':$currentStatus
    };$.ajax({
        type:'get',
        url:"/user/change/role",
        data:$data,
        dataType:'json',
    })
    location.reload();
})
})
</script>
@endsection

