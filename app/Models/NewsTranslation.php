<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','locale_id'];

    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
