<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
     /* The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description','grade', 'localization', 'phone_number', 'website', 'hours'
    ];


	public function menus() 
	{
	    return $this->hasMany('App\Menu');
	}

}
