<?php namespace App\Modules\Olaylar\App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Users\App\Models\User;
use Auth;

class Rapor extends Model {

	//
	protected $table = "olaylar_objeler_raporlar";
	public $timestamps = true;
	protected $guarded = [];

	public function obje()
	{
		return $this->hasOne("App\Modules\Olaylar\App\Models\Obje", "id", "objeId");
	}




}
