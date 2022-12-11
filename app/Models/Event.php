<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;
    protected $table = "events";
    public $translatable = ['title','description','address'];
    protected $guarded = [];
    const Status =[1,0];
}
