<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'welcome to laravel';
        //return view('pages.index',compact('title'));
        return view('pages.index')->with('title' , $title);
        //return view('pages.index');
    }

    public function about()
    {
        $title = 'About';
        return view('pages.about')->with('title' , $title);
        //return view('pages.about');
    }

    public function services()
    {
        $data = array(
            'title' => 'Services',
            'services' => ['web design' , 'programming' , 'SEO']
        );

        return view('pages.services')->with($data);
//        return view('pages.services');
    }
}
