<?php 
namespace App\Models;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
	protected $table = 'visitors';
	protected $fillable = [
	       'ip_address'
	    ];
	
}