<?php 
namespace App\Models;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
	protected $table = 'corporate';
	   public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
	
}