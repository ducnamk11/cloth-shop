@extends('layout.admin')
@section('title','Trang chủ')
@section('css','')
@section('js','')
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
{{--                            @foreach($products as $product)--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">{{$product->id}}</th>--}}
{{--                                    <td>{{$product->name}}</td>--}}
{{--                                    <td>{{$product->name}}</td>--}}
{{--                                    <td>{{$product->name}}</td>--}}
{{--                                    <td>{{$product->name}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a class="btn btn-default" href="{{route(PRODUCT_EDIT,['id'=>product->id])}}">Sửa</a>--}}
{{--                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger" href="{{route(PRODUCT_DELETE,['id'=>$product->id])}}">Xoá</a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
{{--                            {{$products->links()}}--}}
                        </div>
                    </div>
                </div>
             </div>
        </div>
     </div>

@stop
