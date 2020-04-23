@extends('frontend.master')
@section('title','Home - E-Shopper')
@section('css','')
@section('js','')
<script type="text/javascript">
    function UpdateCart(qty, id) {
        $.get(
            '{{asset('frontend/cart/update')}}',
            {qty: qty, id: id},
            function () {
                location.reload();
            }
        )
    }
</script>
@section('main')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    @php(dd($data->attributes))--}}
                    @foreach($data as $item)
                        <tr>
                            <td class="cart_product">
                                <a href="{{route(PRODUCT_DETAIL,['id'=>$item->id])}}"><img
                                        src="{{asset($item->attributes->image)}}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$item->name}}</a></h4>
                                <p>Web ID: 1089772</p>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($item->price)}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <input class="cart_quantity_input"
                                           type="number" name="qty" onchange="UpdateCart(this.value , '{{$item->id}}')"
                                           value="{{$item->quantity}}"
                                           autocomplete="off" size="2">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($item->quantity*$item->price)}} VND</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{route(CART_DELETE,['id'=>$item->id])}}"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">

            <div class="row">

                <div class="col-sm-8">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>{{number_format($total = \Cart::getSubTotal())}} VND</span></li>
                            <li>Eco Tax <span>{{number_format($tax = 30000)}} VND</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>{{number_format($total +$tax)}} VND</span></li>
                        </ul>
                        <a class="btn btn-default check_out" href="{{route(CART_CHECKOUT)}}">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@stop
