<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    protected $product;

    public function __construct(Cart $cart, Product $product)
    {
        $this->cart = $cart;
        $this->product = $product;
    }

    public function add($id)
    {
        $product = $this->product->find($id);
        \Cart::add(array(
            'id' => $id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array('image' => $product->feature_image_path),
            'associatedModel' => $product
        ));
        return redirect('frontend/cart');
    }

    public function index()
    {
        $data = \Cart::getContent();
        $total = \Cart::getTotal();
        return view('frontend/cart', compact('data', 'total'));
    }

    public function update(Request $request)
    {
        \Cart::update($request->id, [
            'quantity' => $request->qty,
        ]);
    }

    public function checkOut()
    {
        $data = \Cart::getContent();
        $total = \Cart::getTotal();
        return view('frontend/checkout', compact('data', 'total'));
    }

    public function delete($id)
    {
        if (isset($id)) {
            \Cart::remove($id);
        } else {
            \Cart::clear();
        }
        return back();
    }
}
