@extends('layout.admin')
@section('title','Trang chủ')
@section('css','')
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{asset('admins/slider/index/list.js')}}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.content_header',['name'=>'Slider','key'=>'list'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route(SLIDER_ADD)}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-10">
                        <table style="table-layout:fixed;"    class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Hình ảnh</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{$slider->id}}</th>
                                    <td >{{$slider->name}}</td>
                                    <td >{{$slider->description}}</td>
                                    <td>
                                        <img style="height: 150px" src="{{asset($slider->image_path)}}" alt="">
                                    </td>
                                    <td>{{optional($slider->category)->name}}</td>
                                    <td>
                                        <a class="btn btn-default"
                                           href="{{route(SLIDER_EDIT,['id'=>$slider->id])}}">Sửa</a>
                                        <a data-url="{{route(SLIDER_DELETE,['id'=>$slider->id])}}"
                                           class="btn btn-danger action_delete_slider"
                                        >Xoá</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            {{$sliders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
