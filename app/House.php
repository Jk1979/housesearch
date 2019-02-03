<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = ['name','price','bedrooms','bathroomas','storeys','garages','created_at','updated_at'];
}
