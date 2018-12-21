<?php

namespace lsapp\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to this App!";
        return view('pages.index')->with('title',$title);

    }

    public function about(){
        $title = "About US";
        return view("pages.about")->with('title',$title);
    }

    public function services(){
        return view("pages.services");
    }
}
