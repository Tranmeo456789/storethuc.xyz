<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
use Socialite;
class SocialController extends Controller
{
    function getInfo($social){
        return Socialite::driver($social)->redirect();
    }
    function checkInfo($social){
        $info = Socialite::driver($social)->user();
        dd($info);
    }
}
