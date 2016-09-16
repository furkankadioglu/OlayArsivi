<?php
namespace App\Modules\Olaylar\App;
 /**
 *	Olaylar Helper  
 */
use App\Modules\Olaylar\App\Models\Olay;
use App\Modules\Olaylar\App\Models\Obje;
use App\Modules\Olaylar\App\Models\ObjeTipi;
use App\Modules\Olaylar\App\Models\ObjeRapor;

 class OlaylarHelpers
 {
 		public static function sonOlaylar()
 		{
 			$bihaftaonce = new \DateTime('7 days ago');
 			$bihaftaonce->format('Y-m-d');
 			$bugun = date("Y-m-d");
 			$olaylar = Olay::whereBetween('baslangicTarihi', [$bihaftaonce, $bugun])->orWhereBetween('bitisTarihi', [$bihaftaonce, $bugun])->orderBy('toplamObjeSayisi', 'desc')->get();
 			return $olaylar;
 		}
 }