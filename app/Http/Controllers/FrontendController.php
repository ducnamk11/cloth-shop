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
        $htmlOption = $this->getCategory($parentId = '');
        return view('frontend.home', compact('sliders','news','htmlOption'));
    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->CategoryRecusiveMenu($parentId);
        return $htmlOption;
    }

}
