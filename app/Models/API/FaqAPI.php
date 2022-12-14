<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FaqAPI extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = "faqs";
    public $translatable  = ['question', 'answer'];
    protected $fillable = [
        'question',
        'answer',
    ];
    protected $hidden = [
        'created_at', 'updated_at' ,'deleted_at'
    ];
    protected function question(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTranslation('question',app()->getLocale()),
        );
    }
    protected function answer(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTranslation('answer',app()->getLocale()),
        );
    }

}
