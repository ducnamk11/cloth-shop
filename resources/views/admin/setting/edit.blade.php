@extends('layout.admin')
@section('title','Slider')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content_header',['name'=>'Setting','key'=>'Edit'])
        {{--        @include('errors.note') Hiển thị các lỗi lên trên Cùng --}}
        <form method="post" action="{{route(SETTING_UPDATE,['id'=>$setting->id])}}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên config key</label>
                                <input required name="config_key" type="text" class="form-control @error('config_key') is-invalid @enderror"
                                       value="{{$setting->config_key}}" placeholder="Nhập tên sản phẩm">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tên config value</label>
                                @if(request()->type ==='text')

                                    <input required name="config_value" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{old('name')}}" placeholder="Nhập config value">

                                @else
                                    <textarea required name="config_value" type="text" rows="5"
                                              class="form-control @error('name') is-invalid @enderror"
                                    >{{$setting->config_value}}</textarea>

                                @endif
                                @error('config_value')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{asset('admins/product/add/add.js')}}"></script>
    <script>
        const URL_FILEMANAGER = '{{route("unisharp.lfm.show")}}';
    </script>
@endsection
