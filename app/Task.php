<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $guarded = [];
    protected $fillable = array('name', 'title', 'email', 'phone', 'total' , 'credit');

    
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');

    }//end of the products
   


}//end of model
