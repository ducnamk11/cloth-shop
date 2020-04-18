<?php

namespace App\Http\Controllers;

use App\Category;
use App\Component\Recusive;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    public function index()
    {
//        $products = $this->product->latest()->paginate(8);
        return view(PRODUCT_INDEX); // compact('product')
     }
//
    public function add()
    {
        $htmlOption = $this->getCategory($parentId='');
         return view(PRODUCT_ADD,compact('htmlOption') ); //compact('htmlOption')
    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->CategoryRecusive($parentId);
        return $htmlOption;
    }
//
//
//    public function store(Request $request)
//    {
//
//        $this->category->create([
//            'name' => $request->name,
//            'parent_id' => $request->parent_id,
//            'slug' => Str::slug($request->name)
//        ]);
//        return redirect()->route(CATEGORY_INDEX);
//    }
//
//
//
//    public function edit($id)
//    {
//        $category = $this->category->find($id);
//        $htmlOption = $this->getCategory($category->parent_id);
//        return view(CATEGORY_EDIT, compact('category','htmlOption'));
//
//    }
//    public function update(Request $request, $id)
//    {
//        $this->category->find($id)->update([
//            'name' => $request->name,
//            'parent_id' => $request->parent_id,
//            'slug' => Str::slug($request->name)
//        ]);
//        return redirect()->route(CATEGORY_INDEX);
//
//    }
//
//    public function delete($id)
//    {
//        $this->category->find($id)->delete();
//        return redirect()->route(CATEGORY_INDEX);
//    }
//    public function getCategory($parentId)
//    {
//        $data = $this->category->all();
//        $recusive = new Recusive($data);
//        $htmlOption = $recusive->CategoryRecusive($parentId);
//        return $htmlOption;
//    }
}
