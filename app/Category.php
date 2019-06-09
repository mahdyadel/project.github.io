<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];
    protected $fillable = array('name','description');

    public function products()
    {
        return $this->hasMany(Product::class);

    }//end of products

}//end of model
