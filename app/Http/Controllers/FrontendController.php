<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Component\Recusive;
use App\Http\Requests\addCommentRequest;
use App\Product;
use App\ProductImage;
use App\Slider;
 use Illuminate\Http\Request;
class FrontendController extends Controller
{
    protected $product;
    protected $slider;
    protected $comment;

    public function __construct(Product $product, Slider $slider, Category $category, Comment $comment, ProductImage $product_images)
    {
        $this->product = $product;
        $this->slider = $slider;
        $this->category = $category;
        $this->comment = $comment;
        $this->product_images = $product_images;
    }

    public function home()
    {
        $sliders = $this->slider->paginate(8);
        $news = $this->product->latest()->take(6)->get();
        $htmlOption = $this->getCategory($parentId = '');
        return view('frontend.home', compact('sliders', 'news', 'htmlOption'));
    }

    public function category($id)
    {
        $category = $this->category->find($id);
        $products = $this->category->find($id)->products;
        $htmlOption = $this->getCategory($parentId = '');
        return view('frontend.category', compact('htmlOption', 'category', 'products'));
    }

    public function product($id)
    {
        $product = $this->product->find($id);
        $comments = $this->comment->where('comment_product',$id)->get();
        $product_images = $this->product_images->where('product_id', $id)->get();
        $htmlOption = $this->getCategory($parentId = '');
        return view('frontend.product-details', compact('htmlOption', 'product', 'comments', 'product_images'));
    }

    public function comment(addCommentRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->name,
            'content' => $request->comment,
            'comment_product' => $id,
        ];
        $this->comment->create($data);
        return back();
    }


    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->CategoryRecusiveMenu($parentId);
        return $htmlOption;
    }

}
