<?php namespace App\Modules\Olaylar\App\Models;

use Illuminate\Database\Eloquent\Model;

class Obje extends Model {

	//
	protected $table = "olaylar_objeler";
	public $timestamps = true;
	protected $guarded = [];

	public function raporlar()
	{
		return $this->hasMany("App\Modules\Olaylar\App\Models\ObjeRapor", "objeId", "id");
	}

	public function olay()
	{
		return $this->hasOne("App\Modules\Olaylar\App\Models\Olay", "id", "olayId");
	}

		public function tip()
	{
		return $this->hasOne("App\Modules\Olaylar\App\Models\ObjeTipi", "id", "objeTypeId");
	}


}
