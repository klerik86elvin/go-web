<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocaleRequest;
use App\Http\Resources\Lang;
use App\Models\Locale;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function getAll()
    {
        $locales = Locale::select('id','name')->get();
        return response(Lang::collection($locales), 200);
    }
    public function get(Locale $lang)
    {
        return new Lang($lang);
    }
    public function edit(Locale $lang, LocaleRequest $request)
    {
        $data = $request->validated();
        $lang->update($data);
        return response(new Lang($lang), 200);
    }
    public function store(LocaleRequest $request)
    {
        $data = $request->validated();
        $lang = Locale::create($data);
        return response(new Lang($lang), 201);
    }
    public function delete(Locale $lang)
    {
        $lang->delete();
        return response(['message' => 'deleted'], 204);
    }
}
