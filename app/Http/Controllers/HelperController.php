<?php


namespace App\Http\Controllers;

//test
use Illuminate\Support\Facades\App;

class HelperController extends Controller
{
    public function setLocale($locale)
    {
        if (! in_array($locale, ['ru', 'kk'])) {
            abort(400);
        }

        if(is_null($locale)){
            if(session()->has('locale')) {
                App::setLocale(session('locale'));
            }
        } else {
            session(['locale' => $locale]);
            App::setLocale($locale);
        }

        return redirect()->back();
    }
}
