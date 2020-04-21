<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $settings = $this->setting->paginate(8);
        return view(SETTING_INDEX, compact('settings'));
    }
 //
    public function add()
    {
        return view(SETTING_ADD);
    }
 //
    public function store(Request $request)
    {
        $this->setting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
        ]);
        return redirect()->route(SETTING_INDEX);
    }
//
    public function edit($id, Request $request)
    {
        $setting = $this->setting->find($id);
        return view(SETTING_EDIT, compact('setting'));
    }
//
    public function update(Request $request, $id)
    {
        $this->setting->find($id)->update([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
        ]);
        return redirect()->route(SETTING_INDEX);
    }
//
    public function delete($id)
    {
        try {
            $this->setting->find($id)->delete();
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
        return redirect()->route(SETTING_INDEX);
    }
}
