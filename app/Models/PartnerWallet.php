<?php 
namespace App\Models;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class PartnerWallet extends Model
{
	protected $table = 'partner_wallet';
	protected $fillable = [
	       'name','type','category','amount'
	    ];
	
}