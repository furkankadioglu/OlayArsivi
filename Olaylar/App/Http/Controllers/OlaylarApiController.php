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

// Helpers
use App\Modules\Olaylar\App\OlaylarHelpers as ModuleHelpers;

// Models
use App\Modules\Olaylar\App\Models\Olaylar;
use App\Modules\Olaylar\App\Models\OlaylarModuleSetting;

use App\Http\Controllers\ApiTemplateController;
class OlaylarApiController extends ApiTemplateController {

	public function index()
	{
		$datas = Olaylar::orderBy('id', 'desc')->get();
		return $datas;
	}

	public function create()
	{
		 return response()->json(["target" => "create"]);
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');
		$apiPassword = $request->header('apiPassword');

		if($apiPassword == Config::get('modulemanagement.apiPassword'))
		{
			if($postCategory == "create")
			{
		 		return response()->json(["target" => "create"]);
			}
		}
	}

	public function show($id)
	{
		 return response()->json(["target" => "show"]);
	}

	public function edit($id)
	{
		 return response()->json(["target" => "edit"]);
	}

	public function update($id)
	{
		 return response()->json(["target" => "update"]);
	}

	public function destroy($id)
	{
		 return response()->json(["target" => "destroy"]);
	}

}
