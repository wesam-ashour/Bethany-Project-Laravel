<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class PlacesAPI extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;
    protected $table = "places";
    public $translatable = ['title','description','location'];
    protected $guarded = [];
    protected $hidden = [
        'type','added_by','updated_at','deleted_at'
    ];
    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTranslation('title',app()->getLocale()),
        );
    }
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTranslation('description',app()->getLocale()),
        );
    }
    protected function location(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTranslation('location',app()->getLocale()),
        );
    }
    public function getImageAttribute($value)
    {
        return url(asset('public/images/places/'.$value));
    }
}
