<?php

namespace DRG\Welcome\Http\Controller;

use Illuminate\Http\Request;
use Seat\Services\Settings\Profile;
use Seat\Web\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function showMainPage()
    {
        $email = auth()->user()->group()->getResults()->getEmailAttribute();
        if ($email === null) {
            $tel = null;
        } else {
            preg_match('/(?<TEL>[+0-9]*)/', $email, $matches);
            if (count($matches) > 0) {
                $tel = $matches['TEL'];
            } else {
                $tel = null;
            }
        }
        return view('welcome::main', [
            'tel' => $tel,
            'language' => Profile::get('language'),
        ]);
    }

    public function bindTel(Request $request)
    {
        if ($request->tel === null) {
            abort(404);
        }
        Profile::set('email_address', "{$request->tel}@tel.com");
        if ($request->isAjax !== '1') {
            return back()->withInput();
        }
    }

    public function switchLang(Request $request)
    {
        if ($request->lang === null) {
            abort(404);
        }
        Profile::set('language', $request->lang);
        return back()->withInput();
    }
}
