<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Blog;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = \App\Blog::where('accept', 1)->orderBy('updated_at','dsc')->paginate(5);
        return view('welcome',['blogs'=>$blogs]);
    }
    public function view(Request $request)
    {   $input=$request->all();
        $accept=0;
        $blog = \App\Blog::find($input['id']);
        $user=\App\User::find($blog->author_id);
        return view('view',['blog'=>$blog,'author'=>$user]);
    }
}
