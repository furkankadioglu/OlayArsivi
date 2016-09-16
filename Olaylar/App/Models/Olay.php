<?php namespace App\Modules\Olaylar\App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Olaylar\App\Models\Begeni;
use App\Modules\Olaylar\App\Models\Favori;
use Auth;

class Olay extends Model {

	//
	protected $table = "olaylar_olaylar";
	public $timestamps = true;
	protected $guarded = [];

	public function objeler()
	{
		return $this->hasMany("App\Modules\Olaylar\App\Models\Obje", "olayId", "id")->where('status', 1);
	}

	public function sonObjeler()
	{
		return $this->hasMany("App\Modules\Olaylar\App\Models\Obje", "olayId", "id")->where('status', 1)->take(3);
	}


	
	public function user()
	{
		return $this->hasOne("App\Modules\Users\App\Models\User", "id", "userId");
	}

	public function varmi($tur)
	{
		if($tur == "like")
		{
			$begeniler = Begeni::where('userId', Auth::user()->id)->where('olayId', $this->attributes["id"])->first();
			if($begeniler)
				return 1;
			else
				return 0;
		}
		else
		{
			$begeniler = Favori::where('userId', Auth::user()->id)->where('olayId', $this->attributes["id"])->first();
			if($begeniler)
				return 1;
			else
				return 0;
		}
		
	}



}
