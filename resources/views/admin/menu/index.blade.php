@extends('layout.admin')
@section('title','Trang chủ')
@section('css','')
@section('js','')
@section('content')
    <div class="content-wrapper">
        @include('partials.content_header',['name'=>'Menu','key'=>'list'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route(MENU_ADD)}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Menu</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <th scope="row">{{$menu->id}}</th>
                                    <td>{{$menu->name}}</td>
                                    <td>
                                        <a class="btn btn-default" href="{{route(MENU_EDIT,['id'=>$menu->id])}}">Sửa</a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"
                                           href="{{route(MENU_DELETE,['id'=>$menu->id])}}">Xoá</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                                                        {{$menus->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
