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
class OlaylarAdminController extends AdminTemplateController {

	public $headName = "Olaylar";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = Olay::orderBy('id', 'desc')->get();
		return view("Olaylar::admin.".$this->theme.".index")
		->with('datas', $datas)
		->with('headName', $this->headName);
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

		if($postCategory == "create")
		{
			$rules = array(
				// variables
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
                return back();
            }

            $data = Olay::create([
            	// variables
            ]);

            return redirect("admin/modules/Olaylar");
		}
		elseif($postCategory == "dateSearch")
		{
			$rules = array(
				'date1' => 'required',
				'date2' => 'required'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
                return back();
            }

            $date1 = $request->get('date1');
            $date2 = $request->get('date2');


            $datas = Olay::whereBetween('baslangicTarihi', [$date1,$date2])->orWhereBetween('bitisTarihi', [$date1,$date2])->get();

            return view("Olaylar::admin.".$this->theme.".index")
			->with('datas', $datas)
			->with('headName', $this->headName);

            
		}

		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = Olay::find($id);
		if($data != null)
		{
			return view("Olaylar::admin.".$this->theme.".show")
			->with('id', $id)
			->with('data', $data)
			->with('headName', $this->headName);
		}
		return back();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = Olay::find($id);
		if($data != null)
		{
			return view("Olaylar::admin.".$this->theme.".edit")
			->with('id', $id)
			->with('data', $data)
			->with('headName', $this->headName);
		}
		return back();
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$rules = array(
				'name' => 'required',
				'slug' => 'required',
				'baslangicTarihi' => 'required',
				'bitisTarihi' => 'required',
			);

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) 
	    {
            return back()->withErrors($validator);
	    }

	    $name = $request->get('name');
	    $slug = $request->get('slug');
	    $baslangicTarihi = $request->get('baslangicTarihi');
	    $bitisTarihi = $request->get('bitisTarihi');

	    if(strtotime($baslangicTarihi) > strtotime($bitisTarihi))
	    {
	    	return back();
	    }

	    $data = Olay::find($id);
	    if($data != null)
	    {
	    	$data->name = $name;
	    	$data->slug = $slug;
	    	$data->baslangicTarihi = $baslangicTarihi;
	    	$data->bitisTarihi = $bitisTarihi;
	    	
	    	$data->save();
            return redirect("admin/modules/Olaylar");
	    }
	    return back();
	}

	public function objectDestroy($id)
	{
		$obje = Obje::find($id);
		$obje->delete();
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
		$data = Olay::find($id);
		if($data != null)
		{
			$data->delete();
			return view("Olaylar::admin.".$this->theme.".destroy")
			->with('id', $id)
			->with('headName', $this->headName);
		}
		return back();

		
	}

}
