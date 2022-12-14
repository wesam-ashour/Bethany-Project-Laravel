<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ScannedsAPI extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "scanneds";
    protected $guarded = [];

}
