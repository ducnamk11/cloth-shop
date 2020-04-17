@extends('layout.admin')
@section('title','Trang chủ')
@section('css','')
@section('js','')
@section('content')
    <div class="content-wrapper">
        @include('partials.content_header',['name'=>'Category','key'=>'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" action="{{route(CATEGORY_STORE)}}">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input name="name" type="text" class="form-control" placeholder="Nhập tên danh mục">
                            </div>
                            <div class="form-group">

                                <label>Chọn danh mục cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Danh mục cha</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </div>

@stop

