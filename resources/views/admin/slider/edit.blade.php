@extends('layout.admin')
@section('title','Slider')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{asset('admins/slider/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content_header',['name'=>'Slider','key'=>'Add'])
        {{--        @include('errors.note') Hiển thị các lỗi lên trên Cùng --}}
        <form method="post" action="{{route(SLIDER_UPDATE,$slider->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       value="{{$slider->name}}" placeholder="Nhập tên sản phẩm">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>

                                <textarea name="description"
                                          class="form-control @error('description') is-invalid @enderror" rows="4">
                               {{$slider->description}}
                                </textarea>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Ảnh </label>
                                <img src="{{asset($slider->image_path)}}" alt="">
                                <input value="{{old('image_path')}}  " name="image_path" type="file"
                                       class="form-control-file @error('image_path') is-invalid @enderror">
                                @error('image_path')
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
    <script src="{{asset('admins/slider/add/add.js')}}"></script>
    <script>
        const URL_FILEMANAGER = '{{route("unisharp.lfm.show")}}';
    </script>
@endsection
