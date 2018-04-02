<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EatenFoodstuff extends Model
{
    use SoftDeletes;

    public static function boot()
	{
		parent::boot();

        static::saving(function($element) {
            $element->name = $element->foodstuff->name;
        });
    }

    public function foodstuff()
	{
		return $this->belongsTo('App\Foodstuff', 'foodstuff_id');
    }
    
    public function getCalories()
    {
        return $this->foodstuff ? 
            round($this->grams * $this->foodstuff->calories / 100, 1)
            : 'Не определено';
    }
}
