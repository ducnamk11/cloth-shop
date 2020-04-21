<?php

namespace App\Http\Controllers;

use App\Category;
use App\Component\Recusive;
use App\Product;
use App\Slider;

class FrontendController extends Controller
{
    protected $product;
    protected $slider;

    public function __construct(Product $product, Slider $slider, Category $category)
    {
        $this->product = $product;
        $this->slider = $slider;
        $this->category = $category;
    }

    public function home()
    {
        $sliders = $this->slider->paginate(8);
        $news =  $this->product->latest()->take(6)->get();
        $category = $this->category->all();
//        dd($category);
//        $htmlOption = $this->getCategory($parent_id = 0);
        return view('frontend.home', compact('sliders','news'));
    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->CategoryRecusive($parentId);
        return $htmlOption;
    }
}
