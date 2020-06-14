<?php

namespace App\Http\Controllers;

use App\Blanket;
use App\Module;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Public dashboard
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $blankets = Blanket::where("date", "<", Carbon::now()->subDay())->get();

        $modules = Module::with('courses.templates')->get();

        return view('home', compact('blankets', 'modules'));
    }

    /**
     * Admin dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $blankets = Blanket::with('template.course.module')->latest()->take(15)->get();
        return view('index', compact('blankets'));
    }
}
