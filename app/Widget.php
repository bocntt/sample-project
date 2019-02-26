<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\SuperModel;

use App\Traits\HasModelTrait;

class Widget extends SuperModel
{
  use HasModelTrait;
  
    protected $fillable = ['name', 'slug', 'user_id'];

    /*
    * Get the user that owns the widget
    */
    public function user() {
      return $this->belongsTo('App\User');
    }
}
