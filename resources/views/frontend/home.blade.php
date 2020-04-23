@extends('frontend.master')
@section('title','Home - E-Shopper')
@section('css','')
@section('js','')
@section('main')
    <section id="slider">
        @include('frontend.layout.slider')
    </section><!--/slider-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('frontend.layout.left-sidebar-index')
                </div>
                @include('errors.notice')

                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center">New Items</h2>
                        @foreach($news as $new)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset($new->feature_image_path)}}" alt=""/>
                                            <h2>{{number_format($new->price)}} vnđ</h2>
                                            <p>{{$new->name}}</p>
                                            <a href="{{route(PRODUCT_DETAIL,['id'=>$new['id']])}}"
                                               class="btn btn-default add-to-cart"><i class="fa fa-plus-square"></i>Detail</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="{{route(PRODUCT_DETAIL,['id'=>$new['id']])}}"
                                                   class="btn btn-default add-to-cart"><i class="fa fa-plus-square"></i>Chi
                                                    tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="{{route(CART_ADD,['id'=>$new['id']])}}"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>


                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    @foreach($news as $new)
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img width="100px" src="{{asset($new->feature_image_path)}}"  />                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="item">

                                    @foreach($news as $new)
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img width="100px" src="{{asset($new->feature_image_path)}}"  />
                                                        <h2>{{$new->price}}</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel"
                               data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel"
                               data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>
@stop
