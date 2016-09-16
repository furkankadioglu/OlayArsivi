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
use App\Modules\Olaylar\App\Models\Favori;
use App\Modules\Olaylar\App\Models\Begeni;
use App\Modules\Olaylar\App\Models\Rapor;
use App\Modules\Olaylar\App\Models\Olay;
use App\Modules\Olaylar\App\Models\Obje;
use App\Modules\Olaylar\App\Models\ObjeTipi;
use App\Modules\Olaylar\App\Models\ObjeRapor;

use App\Modules\Olaylar\App\Models\OlaylarModuleSetting;


use App\Http\Controllers\MainTemplateController;
class OlaylarController extends MainTemplateController {

	public function index()
	{
		$datas = Olay::orderBy('id', 'desc')->paginate(15);
		return view("Olaylar::".$this->theme.".index")
		->with('datas', $datas);
	}

	public function show($id)
	{
		

		if($id == "ara")
		{
			return view("Olaylar::".$this->theme.".search");
		}

		$data = Olay::where("slug", $id)->first();
		if($data != null)
		{

			return view("Olaylar::".$this->theme.".show")
			->with('id', $id)
			->with('data', $data);	
		}
		return back();
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "dateSearch")
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
            return view("Olaylar::".$this->theme.".index")
			->with('datas', $datas);

            
		}
		elseif($postCategory == "begeniEkle")
		{
			// { userId: {{ Auth::user()->id }}, postCategory: "begeniEkle", dataId: EntryID, _token: "{{ csrf_token() }}" },

			$rules = array(
				'userId' => 'required',
				'dataId' => 'required'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
                return back();
            }

            $userId = $request->get('userId');
            $dataId = $request->get('dataId');

			$begeniler = Begeni::where('userId', Auth::user()->id)->where('olayId', $dataId)->first();
            if($begeniler)
            	return back();

            $obj = new Begeni;
            $obj->olayId = $dataId;
            $obj->userId = Auth::user()->id;
            $obj->save(); 


		}
		elseif($postCategory == "favoriEkle")
		{
			// { userId: {{ Auth::user()->id }}, postCategory: "begeniEkle", dataId: EntryID, _token: "{{ csrf_token() }}" },

			$rules = array(
				'userId' => 'required',
				'dataId' => 'required'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
                return back();
            }

            $userId = $request->get('userId');
            $dataId = $request->get('dataId');

            $begeniler = Favori::where('userId', Auth::user()->id)->where('olayId', $dataId)->first();
            if($begeniler)
            	return back();

            $obj = new Favori;
            $obj->olayId = $dataId;
            $obj->userId = Auth::user()->id;
            $obj->save(); 


		}
		elseif($postCategory == "create")
		{
				$rules = array(
					'name' => 'required',
					'baslangicTarihi' => 'required',
					'bitisTarihi' => 'required',
				);

				$validator = Validator::make($request->all(), $rules);

				if($validator->fails()) 
			    {
		            return back()->withErrors($validator);
			    }

			    $name = $request->get('name');
			    $baslangicTarihi = $request->get('baslangicTarihi');
			    $description = $request->get('description');
			    $bitisTarihi = $request->get('bitisTarihi');

			    $links = $request->get('links');
			    $photos = $request->get('photos');
			    $videos = $request->get('videos');

			    if(strtotime($baslangicTarihi) > strtotime($bitisTarihi))
			    {
			    	return back();
			    }

			    if($links == [] AND $photos == [] AND $videos == [])
			    {
			    	return back();
			    }

			    $olay = new Olay;
			    $olay->name = $name;
			    $olay->description = $description;
			    $olay->slug = str_slug($name);
			    $olay->baslangicTarihi = $baslangicTarihi;
			    $olay->bitisTarihi = $bitisTarihi;
			    $olay->toplamObjeSayisi = 0;
			    $olay->toplamGoruntulenmeSayisi = 0;
			    $olay->status = 1;
			    $olay->userId = Auth::user()->id;
			    $olay->save();

			    if($links != "[]")
			    {
				    foreach((array)$links as $link)
				    {
				    	if($link != "")
				    	{
				    		$obje = new Obje;
			    			$obje->slug = str_slug(time().rand(500,300000));
				    		$obje->olayId = $olay->id;
				    		$obje->userId = Auth::user()->id;
				    		$obje->objeTypeId = 1;
				    		$obje->goruntulenmeSayisi = 1;
				    		$obje->sourceUrl = $link;
				    		$obje->photoId = 0;
				    		$obje->save();

				    		$olay->toplamObjeSayisi += 1;
				    		$olay->save();
				    	}
				    }
				}

			    if($photos != "[]")
			    {
			    	foreach((array)$photos as $photo)
				    {
				    	if($photo != "")
				    	{
				    		$obje = new Obje;
			    			$obje->slug = str_slug(time().rand(500,300000));
				    		$obje->olayId = $olay->id;
				    		$obje->userId = Auth::user()->id;
				    		$obje->objeTypeId = 2;
				    		$obje->goruntulenmeSayisi = 1;
				    		$obje->sourceUrl = $photo;
				    		$obje->photoId = 0;
				    		$obje->save();

				    		$olay->toplamObjeSayisi += 1;
				    		$olay->save();
				    	}
				    }
			    }
			    
			 if($videos != "[]")
		     {
			    foreach((array)$videos as $video)
			    {
			    	if($video != "")
			    	{
			    		$obje = new Obje;
			    		$obje->slug = str_slug(time().rand(500,300000));
			    		$obje->olayId = $olay->id;
			    		$obje->userId = Auth::user()->id;
			    		$obje->objeTypeId = 3;
			    		$obje->goruntulenmeSayisi = 1;
			    		$obje->photoId = 0;
			    		$obje->sourceUrl = $video;
			    		$obje->save();

			    		$olay->toplamObjeSayisi += 1;
			    		$olay->save();
			    	}
			    }
			}

		    return redirect('/Olaylar/'.$olay->slug);

		}
		elseif($postCategory == "add")
		{
			$rules = array(
				'olayId' => 'required'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
		    {
	            return back()->withErrors($validator);
		    }

		    $links = $request->get('links');
		    $photos = $request->get('photos');
		    $videos = $request->get('videos');

		    $olayId = $request->get('olayId');

		    $olay = Olay::find($olayId);
		    if(!$olay)
		    	return back();


		    if($links == [] AND $photos == [] AND $videos == [])
		    {
		    	return back();
		    }

		    if($links != "[]")
			    {
				    foreach((array)$links as $link)
				    {
				    	if($link != "")
				    	{
				    		$obje = new Obje;
			    			$obje->slug = str_slug(time().rand(500,300000));
				    		$obje->olayId = $olay->id;
				    		$obje->userId = Auth::user()->id;
				    		$obje->objeTypeId = 1;
				    		$obje->goruntulenmeSayisi = 1;
				    		$obje->sourceUrl = $link;
				    		$obje->photoId = 0;
				    		$obje->save();

				    		$olay->toplamObjeSayisi += 1;
				    		$olay->save();
				    	}
				    }
				}

		    if($photos != "[]")
			    {
			    	foreach((array)$photos as $photo)
				    {
				    	if($photo != "")
				    	{
				    		$obje = new Obje;
			    			$obje->slug = str_slug(time().rand(500,300000));
				    		$obje->olayId = $olay->id;
				    		$obje->userId = Auth::user()->id;
				    		$obje->objeTypeId = 2;
				    		$obje->goruntulenmeSayisi = 1;
				    		$obje->sourceUrl = $photo;
				    		$obje->photoId = 0;
				    		$obje->save();

				    		$olay->toplamObjeSayisi += 1;
				    		$olay->save();
				    	}
				    }
			    }
			    
			 if($videos != "[]")
		     {
			    foreach((array)$videos as $video)
			    {
			    	if($video != "")
			    	{
			    		$obje = new Obje;
			    		$obje->slug = str_slug(time().rand(500,300000));
			    		$obje->olayId = $olay->id;
			    		$obje->userId = Auth::user()->id;
			    		$obje->objeTypeId = 3;
			    		$obje->goruntulenmeSayisi = 1;
			    		$obje->photoId = 0;
			    		$obje->sourceUrl = $video;
			    		$obje->save();

			    		$olay->toplamObjeSayisi += 1;
			    		$olay->save();
			    	}
			    }
			}

		}
		elseif($postCategory == "report")
		{
			$rules = array(
				'objeId' => 'required',
				'description' => 'required',
				'telefon' => 'required',
				'mail' => 'required'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
		    {
	            return back()->withErrors($validator);
		    }



		    $objeId = $request->get('objeId');
		    $description = $request->get('description');
		    $telefon = $request->get('telefon');
		    $mail = $request->get('mail');

		    $rapor = new Rapor;
		    $rapor->objeId = $objeId;
		    $rapor->description = $description;
		    $rapor->telefon = $telefon;
		    $rapor->mail = $mail;
		    $rapor->status = 1;
		    $rapor->save();

        	$request->session()->flash('flash_message', 'Şikayetiniz iletildi. En kısa zamanda değerlendirilecek ve eğer silinme kriterlerimize uygunsa kaldırılacak veya düzenlenecektir.');


		}
		return redirect("/Olaylar/");
	}

	public function redirect($slug)
	{
		$obje = Obje::where('slug', $slug)->first();
		if($obje)
		{
			$obje->goruntulenmeSayisi += 1;
			$obje->olay->toplamGoruntulenmeSayisi += 1;
			$obje->olay->save();
			$obje->save();
		}

		if (substr($obje->sourceUrl, 0, 7) != "http://" OR substr($obje->sourceUrl, 0, 8) != "https://")
		{
			return redirect()->away("http://".$obje->sourceUrl);
		}

		return redirect()->away($obje->sourceUrl);;
	}



	public function login()
	{
		return view("Olaylar::".$this->theme.".login");
	}

	public function destroy($id)
	{
		return view("Olaylar::".$this->theme.".destroy")
		->with('id', $id);
	}

	public function create()
	{
		if(Auth::check())
		{
		return view("Olaylar::".$this->theme.".create");
		}
		return back();
	}
	public function objectCreate($olayId)
	{
		if(Auth::check())
		{
			$olay = Olay::find($olayId);
			if(!$olay)
				return back();

			return view("Olaylar::".$this->theme.".objectCreate")
			->with('olayId', $olayId)
			->with('olay', $olay);
		}
		return back();
	}
	public function objectReport($objeId)
	{
		return view("Olaylar::".$this->theme.".objectReport")
		->with('objeId', $objeId);
	}

	public function update($id)
	{
		return back();
	}

	public function edit($id)
	{
		return back();
	}

}
