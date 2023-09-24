<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsTranslate;
use App\Models\Locale;
use App\Models\News;
use App\Models\NewsTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NewsController extends Controller
{
    public function getAll()
    {
        if (\request()->hasHeader('Accept-Language'))
        {
            $locale = Locale::where('name',app()->getLocale())->first();
//            $news = News::whereHas('translations', function ($query) use($locale) {
//                $query->whereHas('locale', function ($subQuery) use ($locale) {
//                    $subQuery->where('name', $locale);
//                });
//            })->get();
            $news = NewsTranslation::where('locale_id', $locale->id)->get();

            return response()->json(NewsTranslate::collection($news), 200, ['Accept-Language' => app()->getLocale()]);
        }
        $news = News::all();
        return response(\App\Http\Resources\News::collection($news),200);

    }

    public function get($id)
    {
        $news = News::findOrFail($id);
        $news->viewCount++;
        $news->save();
        if (\request()->hasHeader('Accept-Language'))
        {
            $locale = Locale::where('name',app()->getLocale())->first();
            $news = NewsTranslation::where(['news_id'=>$id,'locale_id' => $locale->id])->firstOrFail();

            return response(new NewsTranslate($news),200);
        }

        return response(new \App\Http\Resources\News($news), 200);
    }

    public function edit($id, NewsRequest $request)
    {
       $data = $request->validated();
       $news = News::with('translations')->findOrFail($id);
       $news->update([
           'title' => $data['title'],
           'description' => $data['description'],
           'status' => $data['status']
       ]);
       if (Arr::exists($data,'translations'))
       {
           foreach ($data['translations'] as $translation){
               $locale = Locale::where('name',$translation['lang'])->first();
               $news->translations()->updateOrCreate([
                   'title' => $translation['title'],
                   'description' => $translation['description'],
                   'locale_id' => $locale->id
               ]);
           }
       }
       $news->refresh();
       return response($news, 200);
    }
    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        $news = News::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => false
        ]);
        if (Arr::exists($data,'translations'))
        {
            foreach ($data['translations'] as $translation){
                $locale = Locale::where('name',$translation['lang'])->first();
                $news->translations()->create([
                    'title' => $translation['title'],
                    'description' => $translation['description'],
                    'locale_id' => $locale->id
                ]);
            }
        }
        return response($news, 201);
    }
    public function delete(News $news)
    {
        $news->delete();
        return response(['message' => 'deleted'], 204);
    }
}
