@extends('layout.admin')
@section('title','Trang chủ')
@section('css','')
@section('js','')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content_header',['name'=>'Category','key'=>'list'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route(CATEGORY_ADD)}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <a class="btn btn-default" href="{{route(CATEGORY_EDIT,['id'=>$category->id])}}">Sửa</a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger" href="{{route(CATEGORY_DELETE,['id'=>$category->id])}}">Xoá</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            {{$categories->links()}}
                        </div>
                    </div>
                </div>
             </div>
        </div>
     </div>

@stop
