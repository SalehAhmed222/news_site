<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

      //this function for protects permessions from admin write routes to open pages
      public function __construct()
      {
          $this->middleware('can:settings');

      }
    public function index()
    {

        return view('admin.setting.index');
    }
    public function update(SettingRequest $request)
    {

        $request->validated();
        try {
            DB::beginTransaction();
            $current_setting = Setting::findOrFail($request->setting_id);
            $setting = $current_setting->update($request->except(['_token', 'setting_id', 'logo', 'favicon']));

            if ($request->hasFile('logo')) {
                $this->updateLogo($request , $current_setting);
            }
            if ($request->hasFile('favicon')) {
                $this->updateFavicon($request, $current_setting);
            }
            if (!$setting) {
                DB::rollback();
                return redirect()->back()->with('error', 'Try agian!!');
            }
            DB::commit();
            return redirect()->back()->with('success', 'Update Setting Successfully!!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    private function updateLogo($request, $current_setting)
    {
        ImageManger::deleteImageFromLocal($current_setting->logo);
        $file = ImageManger::generateFileName($request->logo);
        $logo_path = ImageManger::storeImageInLocal($request->logo, 'setting', $file);
        $current_setting->update([
            'logo' => $logo_path,
        ]);
    }
    private function updateFavicon($request, $current_setting)
    {
        ImageManger::deleteImageFromLocal($current_setting->favicon);
        $file = ImageManger::generateFileName($request->favicon);
        $favicon_path = ImageManger::storeImageInLocal($request->favicon, 'setting', $file);
        $current_setting->update([
            'favicon' => $favicon_path,
        ]);
    }
}
