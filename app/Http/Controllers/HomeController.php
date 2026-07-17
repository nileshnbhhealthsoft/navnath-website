<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', ['content' => SiteContent::current()]);
    }
}
