@extends('admin.layouts.master')
@section('title', 'categorylistPage')
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
                                    <input type="text" name="key"
                                        class="form-control"placeholder="search..."value="{{ request('key') }}">
                                    <button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-2 offset-10">
                        <button class="btn btn-success mt-2"><i
                                class="fa-solid fa-users me-2 text-warning"></i>{{ $admins->total() }}</button>
                    </div>

                    <div class="row">
                        <div class="col-4 offset-7 mb-2">
                            @if (session('deleteSuccess'))
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-mark me-2"></i>{{session('deleteSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                            </div>
                            @endif
                        </div>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($admins as $a)
                                <tr>
                                    <td class="col-2">
                                        @if ($a->image != null)
                                            <img src="{{ asset('storage/' . $a->image) }}" alt=""
                                                class="img-thumbnail shadow-sm">
                                        @else
                                            @if ($a->gender == 'male')
                                                <img src="{{ asset('image/default male.png') }}"
                                                    alt=""class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/default female.png') }}"
                                                    alt="" class="img-thumbnail shadow-sm">
                                            @endif
                                        @endif
                                    </td>
                                    <input type="hidden" value="{{ $a->id }}" id="adminId">
                                    <td>{{ $a->name }}</td>
                                    <td class="col-2">{{ $a->email }}</td>
                                    <td>{{ $a->gender }}</td>
                                    <td>{{ $a->phone }}</td>

                                    <td class="">
                                        <select name="" class="form-control changeStatus" id="">
                                            <option value="admin"
                                                @if ($a->role == 'admin') selected @endif>admin</option>
                                            <option value="user"
                                                @if ($a->role == 'user') selected @endif>user</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{route('admin#adminDelete',$a->id)}}">
                                                <button class="item" data-toggle="tooltip"
                                                    data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- main content --}}
@endsection
@section('scriptSection')
    <script>
        $(document).ready(function() {
            $('.changeStatus').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $adminId = $parentNode.find('#adminId').val();


                $data = {
                    'adminId': $adminId,
                    'role': $currentStatus
                };
                $.ajax({
                    type: 'get',
                    url: "/user/admin/change/role",
                    data: $data,
                    dataType: 'json',
                })
                location.reload();
            })
        })
    </script>
@endsection
