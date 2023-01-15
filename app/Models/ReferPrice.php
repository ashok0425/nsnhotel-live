<?php 
namespace App\Models;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ReferPrice extends Model
{
	protected $table = 'refer_price';
	protected $fillable = [
	       'share_price','join_price','refer_content'
	    ];
	const STATUS_PENDING = 0;

	const STATUS_ACTIVE = 1;

	const STATUS_DEACTIVE = 2;
}