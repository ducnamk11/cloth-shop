<?php

namespace App\Http\Controllers;

use App\Category;
use App\Component\Recusive;
use App\Product;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Storage;

class AdminProductController extends Controller
{
    protected $category;
    protected $product;
    use StorageImageTrait;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function index()
    {
//        $products = $this->product->latest()->paginate(8);
        return view(PRODUCT_INDEX); // compact('product')
    }

//
    public function add()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view(PRODUCT_ADD, compact('htmlOption')); //compact('htmlOption')
    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->CategoryRecusive($parentId);
        return $htmlOption;
    }


    public function store(Request $request)
    {
        dd($request->image_path);
        $dataProductCreate = [
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->contents,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id
        ];
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
        if (!empty($dataUploadFeatureImage)) {
            $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        };
        $product = $this->product->create($dataProductCreate);
        //Insert data to prodyuct_image

    }

    public function edit($id)
    {
//        $category = $this->category->find($id);
//        $htmlOption = $this->getCategory($category->parent_id);
//        return view(CATEGORY_EDIT, compact('category','htmlOption'));

    }
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
