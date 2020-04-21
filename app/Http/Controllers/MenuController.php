<?php

namespace App\Http\Controllers;

use App\Component\MenuRecusive;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menuRecusive;
    private $menu;

    public function __construct(MenuRecusive $menuRecusive, Menu $menu)
    {
        $this->menuRecusive = $menuRecusive;
        $this->menu = $menu;
    }

    public function index()
    {
        $menus = $this->menu->paginate(8);
        return view(MENU_INDEX, compact('menus'));
    }

    public function add()
    {
        $htmlOption = $this->menuRecusive->menuRecusiveAdd();
        return view(MENU_ADD, compact('htmlOption'));
        dd($htmlOption);

    }


    public function store(Request $request)
    {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),

        ]);
        return redirect()->route(MENU_INDEX);

    }


    public function edit( $id, Request $request)
    {
        $menu = $this->menu->find($id);
         $htmlOption = $this->menuRecusive->menuRecusiveEdit($menu->parent_id);
        return view(MENU_EDIT, compact('htmlOption','menu'));
    }

    public function update(Request $request, $id)
    {

        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route(MENU_INDEX);

    }

    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route(MENU_INDEX);
    }
}
