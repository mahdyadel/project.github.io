<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];
    protected $fillable = array('name', 'description' , 'price' , 'category_id', 'image' );
    protected $appends = ['image_path'];


    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);

    }//end of image path attribute
    public function categorios()
    {
        return $this->belongsTo(Category::class,'category_id');

    }//end of the categories
    
    public function tasks()
    {
        return $this->hasMany(Task::class);

    }//end of tasks
   


}//end of model
