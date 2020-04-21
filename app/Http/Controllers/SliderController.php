<?php

namespace App\Http\Controllers;

use App\Http\Requests\addSliderRequest;
use App\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use StorageImageTrait;
    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        $sliders = $this->slider->latest()->paginate(8);
        return view(SLIDER_INDEX, compact('sliders'));
    }

    public function add()
    {
        return view(SLIDER_ADD);
    }

    public function store(addSliderRequest $request)
    {
        try {
            $dataInsert = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImageSlider = $this->storageTraitUpload($request, 'image_path', 'slider');
            if ($request->hasFile('image_path')) {
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = $dataImageSlider['file_path'];
            };
            $this->slider->create($dataInsert);


        } catch (\Exception $exception) {
            Log::error('message:' . $exception->getMessage() . '-- line: ' . $exception->getLine());

        }
        return redirect()->route(SLIDER_INDEX);
    }

    public function edit($id)
    {
        $slider = $this->slider->find($id);
        return view(SLIDER_EDIT, compact('slider'));
    }

    public function update(Request $request, $id)
    {
        try {
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImageSlider = $this->storageTraitUpload($request, 'image_path', 'slider');
            if ($request->hasFile('image_path')) {
                $dataUpdate['image_name'] = $dataImageSlider['file_name'];
                $dataUpdate['image_path'] = $dataImageSlider['file_path'];
            };
            $this->slider->find($id)->update($dataUpdate);
            return redirect()->route(SLIDER_INDEX);

        } catch (\Exception $exception) {
            Log::error('message:' . $exception->getMessage() . '-- line: ' . $exception->getLine());
        }
    }

    public function delete($id)
    {

        try {
            $this->slider->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);

        } catch (\Exception $exception) {
            Log::error('message:' . $exception->getMessage() . 'line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail',
            ], 500);
        }
        return redirect()->route(SLIDER_INDEX);

    }
}
