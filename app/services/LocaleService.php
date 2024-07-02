<?php

namespace App\services;

use App\Models\Locale;

class LocaleService
{
    public static function getLocale(){
        if (session()->get('locale')){
            return session()->get('locale');
        }
        $locale = Locale::first() ? Locale::first()->nom : Locale::create(['nom'=>'LOC-1'])->nom;
        session()->put('locale',$locale);
        return $locale;
    }

    public static function getLocaleId(){
        $locale = Locale::where('nom',session()->get('locale'))->first()->id;
        return $locale;
    }
    public static function setSessionLocale($id){
        $locale = Locale::find($id)->nom;
        session()->put('locale',$locale);
        $locales = Locale::all();
        session()->put('locales',$locales);
    }

    public static function setSessionLocales(){
        $locales = Locale::all();
        session()->put('locales',$locales);
    }


}
