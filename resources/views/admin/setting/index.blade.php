@extends('layout.admin')
@section('title','Trang chủ')
@section('css','')
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{asset('admins/setting/index/list.js')}}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.content_header',['name'=>'Slider','key'=>'list'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                         <div class="dropdown float-right px-lg-5">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Add setting
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route(SETTING_ADD).'?type=text'}}">Text</a>
                                <a class="dropdown-item" href="{{route(SETTING_ADD).'?type=textarea'}}">Textarea</a>
                             </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">config_key</th>
                                <th scope="col">config_value</th>
                             </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <th scope="row">{{$setting->id}}</th>
                                    <th scope="row">{{$setting->config_key}}</th>
                                    <th scope="row">{{$setting->config_value}}</th>

                                    <td>
                                        <a class="btn btn-default"
                                           href="{{route(SETTING_EDIT,['id'=>$setting->id])}}">Sửa</a>
                                        <a data-url="{{route(SETTING_DELETE,['id'=>$setting->id])}}"
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
{{--                            {{$setting->links()}}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
