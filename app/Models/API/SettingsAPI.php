<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class SettingsAPI extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;

    protected $table = "options";
    public $translatable = ['foundation','history'];

    protected $hidden = [
        'updated_at','created_at','deleted_at'
    ];


      protected $appends = ['gallerys'];
     public function getGallerysAttribute()
     {
        return  PlacesAPI::query()->select('id','image')->get();;
     }
    protected function foundation(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTranslation('foundation',app()->getLocale()),
        );
    }
    protected function history(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTranslation('history',app()->getLocale()),
        );
    }

}
