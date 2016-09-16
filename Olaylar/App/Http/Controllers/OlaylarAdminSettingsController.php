<?php namespace App\Modules\Olaylar\App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Frameworks
use File;
use Auth;
use Validator;
use DB;
use Config;
use Cache;

// Helpers
use App\BaseHelpers;
use App\Modules\Olaylar\App\OlaylarHelpers as ModuleHelpers;

// Models
use App\Modules\Olaylar\App\Models\Olaylar;
use App\Modules\Olaylar\App\Models\OlaylarModuleSetting;


use App\Http\Controllers\AdminTemplateController;
class OlaylarAdminSettingsController extends AdminTemplateController {

	public $headName = "Olaylar Module Settings";


	public function index()
	{
		$datas = OlaylarModuleSetting::orderBy('id', 'desc')->get();
		return view("Olaylar::admin.".$this->theme.".settings.index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}

	public function create()
	{
		return view("Olaylar::admin.".$this->theme.".settings.create")
		->with('headName', $this->headName);
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "create")
		{
			$rules = array(
				'displayName' => 'required|max:255',
				'name' => 'required|unique:Olaylar_settings|max:255',
				'attribute' => 'required|max:255'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
				return back()->withErrors($validator);
            }

            $settingDisplayName = $request->get('displayName');
            $settingName = str_slug($request->get('name'));
            $settingAttribute = $request->get('attribute');

			$data = OlaylarModuleSetting::create([
				'displayName' => $settingDisplayName,
				'name' => $settingName,
				'attribute' => $settingAttribute
			]);

			$withCache = BaseHelpers::cacheAddOrUpdate("Olaylar" ,$settingName, "");

            return redirect("admin/modules/Olaylar/settings");
		}

		return back();
	}

	public function update(Request $request)
	{
		$settings = OlaylarModuleSetting::orderBy('id', 'desc')->get();
		foreach($settings as $setting)
		{
			$setting->value = $request->get($setting->name);
			$setting->save();
			$withCache = BaseHelpers::cacheAddOrUpdate("Olaylar", $setting->name, $setting->value);
		}
           return redirect("admin/modules/Olaylar/settings");
	}

	public function destroy($id)
	{
		$data = OlaylarModuleSetting::find($id);
		if($data != null)
		{
			$data->delete();
			Cache::pull("OlaylarModule-".$data->name);
		}
		return back();

		
	}

}
