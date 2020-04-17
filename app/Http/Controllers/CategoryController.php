<?php

namespace App\Http\Controllers;

use App\Category;
use App\Component\Recusive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->latest()->paginate(8);
        return view(CATEGORY_INDEX, compact('categories'));
    }

    public function add()
    {
        $htmlOption = $this->getCategory();
        return view('category.add', compact('htmlOption'));
    }


    public function store(Request $request)
    {

        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route(CATEGORY_INDEX);
    }



    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
         return view('category.edit', compact('category','htmlOption'));

    }
 public function update(Request $request, $id)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route(CATEGORY_INDEX);

    }

    public function delete($id)
    {
        $this->category->find($id)->delete();
        return redirect()->route(CATEGORY_INDEX);
    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->CategoryRecusive($parentId);
        return $htmlOption;
    }
}
