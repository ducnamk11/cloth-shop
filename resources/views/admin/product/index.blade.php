@extends('layout.admin')
@section('title','Trang chủ')
@section('css','')
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{asset('admins/product/index/list.js')}}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content_header',['name'=>'Product','key'=>'list'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route(PRODUCT_ADD)}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{number_format($product->price)}} vnđ</td>
                                    <td>
                                        <img style="width: 150px" src="{{asset($product->feature_image_path)}}" alt="">
                                    </td>
                                    <td>{{optional($product->category)->name}}</td>
                                    <td>
                                        <a class="btn btn-default" href="{{route(PRODUCT_EDIT,['id'=>$product->id])}}">Sửa</a>
                                        <a   data-url="{{route(PRODUCT_DELETE,['id'=>$product->id])}}" class="btn btn-danger action_delete"
                                           >Xoá</a>
{{--                                        href="{{route(PRODUCT_DELETE,['id'=>$product->id])}}"--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
