<?php

namespace App\Http\Controllers;

use App\Category;
use App\Component\Recusive;
use App\Http\Requests\productAddRequest;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use App\Traits\StorageImageTrait;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Storage;

class AdminProductController extends Controller
{
    protected $category;
    protected $productImage;
    protected $product;
    protected $tag;
    protected $product_tag;
    use StorageImageTrait;

    public function __construct(Category $category, Product $product, ProductImage $productImage, ProductTag $product_tag, Tag $tag)
    {
        $this->productImage = $productImage;
        $this->category = $category;
        $this->tag = $tag;
        $this->product = $product;
        $this->product_tag = $product_tag;
    }

    public function index()
    {
        $products = $this->product->latest()->paginate(8);
        return view(PRODUCT_INDEX, compact('products'));
    }

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

    public function store(productAddRequest $request)
    {
        try {
            DB::beginTransaction();
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
            //Insert data to product_image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataImageDetail['file_path'],
                        'image_name' => $dataImageDetail['file_name'],
                    ]);
                }
            };
            //Insert taag to product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance;
                    $this->product_tag->create([
                        'product_id' => $product->id,
                        'tag_id' => $tagInstance->id,
                    ]);
                }
            }
            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message:' . $exception->getMessage() . 'line: ' . $exception->getLine());
        }
        return redirect('admin/product/');
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view(PRODUCT_EDIT, compact('product', 'htmlOption')); //
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            };
            $this->product->find($id)->update($dataProductUpdate);


            //Insert data to product_image
            $product = $this->product->find($id);
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataImageDetail['file_path'],
                        'image_name' => $dataImageDetail['file_name'],
                    ]);
                }
            };
            //Insert taag to product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance;
                    $this->product_tag->create([
                        'product_id' => $product->id,
                        'tag_id' => $tagInstance->id,
                    ]);
                }
            }
            DB::commit();
            return redirect('admin/product/');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message:' . $exception->getMessage() . 'line: ' . $exception->getLine());
        }
        return redirect()->route(PRODUCT_INDEX);
    }

    public function delete($id)
    {
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);

        } catch (\Exception $exception) {
            Log::error('message:' . $exception->getMessage() . 'line: ' . $exception->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'fail',
            ],500);
        }
        return redirect()->route(CATEGORY_INDEX);
    }

}
