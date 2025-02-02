<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function properties()
    {
        return view('properties');
    }

    public function property()
    {
        return view('property');
    }

    public function addProperty()
    {
        return view('add-property');
    }

    public function lands()
    {
        return view('lands');
    }

    public function land()
    {
        return view('land');
    }

    
    public function addLand()
    {
        return view('add-land');
    }

    
    public function projects()
    {
        return view('projects');
    }

    public function project()
    {
        return view('project');
    }

    
    public function addProject()
    {
        return view('add-project');
    }
}
