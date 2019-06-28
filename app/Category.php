<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $guarded = [];

    public function parent(){
    	return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(){
    	return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public static function getParents($child){
    	if($child != null){
    		return $child->name.' / '.Category::getParents($child->parent);
    	}
    }

    public static function getGoogleProduct($child){
    	$categories = Category::getParents($child);
    	$cats = explode('/', $categories);
    	$g_cat = "";
    	for($i=count($cats) - 2; $i >= 0; $i--){
    		$g_cat .= $cats[$i]." / ";
    	}
    	return substr_replace($g_cat ,"", -2);;
    }
}
