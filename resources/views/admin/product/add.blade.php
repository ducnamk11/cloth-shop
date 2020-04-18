@extends('layout.admin')
@section('title','Sản Phẩm')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content_header',['name'=>'Product','key'=>'Add'])
        <form method="post" action="{{route(PRODUCT_STORE)}}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            {{--                        {{route(PRODUCT_STORE)}}--}}

                            <div class="form-group">
                                <label>Tên sản phâm</label>
                                <input name="name" type="text" class="form-control" placeholder="Nhập tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input name="price" type="number" class="form-control" placeholder="Nhập giá sản phẩm">
                            </div>
                            <div class="form-group">
                                <label>Ảnh </label>
                                <input name="feature_image_path" type="file" class="form-control-file"
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết </label>
                                <input multiple name="image_path[]" type="file" class="form-control-file"
                            </div>

                            <div class="form-group">
                                <label>Nhập tag cho sản phẩm </label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục cha</label>
                                <select class="form-control select2_init " name="category_id">
                                    <option value="">Danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                        </div>
                    </div>

                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="contents" class="form-control tinymce_editor_init" rows="12"></textarea>
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
        const URL_FILEMANAGER='{{route("unisharp.lfm.show")}}';

     </script>
@endsection
