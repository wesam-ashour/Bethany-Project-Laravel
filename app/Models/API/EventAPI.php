<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class EventAPI extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;
    protected $table = "events";
    public $translatable = ['title','description','address'];
    protected $guarded = [];
    const Status =[1,0];
    
    protected $hidden = [
        'created_at', 'updated_at' ,'deleted_at'
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
    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTranslation('description',app()->getLocale()),
        );
    }
    public function getImageAttribute($value)
    {
        return url(asset('public/images/events/'.$value));
    }
}
