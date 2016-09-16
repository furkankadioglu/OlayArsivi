<?php namespace App\Modules\Olaylar\App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Users\App\Models\User;
use Auth;

class Begeni extends Model {

	//
	protected $table = "olaylar_olaylar_begeniler";
	public $timestamps = true;
	protected $guarded = [];



}
