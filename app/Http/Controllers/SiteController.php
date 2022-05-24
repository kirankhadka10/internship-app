<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(): RedirectResponse
    {
        if(auth()->user()->role == 'Admin'){
            return redirect('/admin');
        }

        return redirect('/');
    }
}
