<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Option extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;
    protected $table = "options";
    public $translatable = ['foundation','history'];
    protected $guarded = [];
}
