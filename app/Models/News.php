<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    public function translations(){
        return $this->hasMany(NewsTranslation::class);
    }
}
