<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Place extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;
    protected $table = "places";
    public $translatable = ['title','description','location'];
    protected $guarded = [];
}
