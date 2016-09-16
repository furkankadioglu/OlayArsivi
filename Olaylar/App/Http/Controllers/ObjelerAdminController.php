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
use App\Modules\Olaylar\App\Models\Olay;
use App\Modules\Olaylar\App\Models\Obje;
use App\Modules\Olaylar\App\Models\ObjeTipi;
use App\Modules\Olaylar\App\Models\ObjeRapor;
use App\Modules\Olaylar\App\Models\OlaylarModuleSetting;


use App\Http\Controllers\AdminTemplateController;
class ObjelerAdminController extends AdminTemplateController {

	public $headName = "Olaylar";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view("Olaylar::admin.".$this->theme.".create")
		->with('headName', $this->headName);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function show($id)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{	
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, $objeId)
	{
		$olay = Olay::find($id);
		$olay->toplamObjeSayisi -= 1;
		$data = Obje::find($objeId);
		if($data != null)
		{
			$data->status = 0;
		}
		return back();

		
	}

}
