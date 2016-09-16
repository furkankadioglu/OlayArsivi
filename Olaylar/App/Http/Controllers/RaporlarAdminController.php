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
use App\Modules\Olaylar\App\Models\Rapor;
use App\Modules\Olaylar\App\Models\ObjeTipi;
use App\Modules\Olaylar\App\Models\ObjeRapor;
use App\Modules\Olaylar\App\Models\OlaylarModuleSetting;


use App\Http\Controllers\AdminTemplateController;
class RaporlarAdminController extends AdminTemplateController {

	public $headName = "Raporlar";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = Rapor::orderBy('id', 'desc')->get();
		return view("Olaylar::admin.".$this->theme.".raporlar.index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = Rapor::find($id);
		if($data)
		{
			$data->obje->olay->toplamObjeSayisi -= 1;
			$data->obje->olay->save();
			$data->obje->delete();
			$data->status = 0;
			$data->save();
		}
			
		return back();
		
	}



	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$data = Rapor::find($id);
		if($data != null)
		{
			$data->status = 0;
			$data->save();
		}
		return back();

		
	}

}
