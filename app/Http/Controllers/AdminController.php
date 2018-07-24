<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Blog;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

     public function login()
    {
        return view('admin.login');
    }

    public function blog()
    {
        return view('admin.blog.index');
    }

   
    public function accept(Request $request)
    {
        $input=$request->all();
        $accept=0;
        $blog = \App\Blog::find($input['id']);
        if($blog->accept=='0'){
           $blog->accept=1 ;
           $accept=1;
        }
        else {
           $blog->accept=0 ;
           $accept=0;
        }
        //$blog->accept=1;
        $blog->save();
        return response()
            ->json(['success'=>'true',
                    'accept'=>$accept
                    ]) ;
        //return redirect()->route('blog');
    }
     public function search(Request $request)
    {
        $input=$request->all();
        $order1=$input['order'][0]['column'];
        $order2=$input['order'][0]['dir'];
        $start=$input['start'];
        $length=$input['length'];
        $search=$input['search']['value'];
        $array=['id','title','discription','accept','created_at','updated_at',"author_id"];
        $id = Auth::id();
        $blogs = \App\Blog::where('accept','!=', 2);
        if(!empty($search))
        {
            
           $blogs->where(function ($query) use ($search) {
                return $query->where('title', 'like', '%' . $search . '%')->orWhere('discription', 'like', '%' . $search . '%');
            });
            
        }
        $blogs=$blogs->orderBy($array[$order1], $order2)
               ->skip($start)
               ->take($length)
               ->get()->toArray();
        $total= \App\Blog::where('accept','!=', 2);
        if(!empty($search))
        {
            
           $total->where(function ($query) use ($search) {
                return $query->where('title', 'like', '%' . $search . '%')->orWhere('discription', 'like', '%' . $search . '%');
            });
            
        }
        $total=$total->orderBy($array[$order1], $order2)
               ->count();
       
        $data=[];
         foreach($blogs as $blog){
           $user=\App\User::find($blog['author_id']);
           if(!empty($user)){
            $user=$user->name;
           }
          $accept=$blog['accept']=="0"?"accept":"unaccept";
           $unaccept=$blog['accept']=="1"?"accepted":"wait";
            $data[]=[$blog['id'],$blog['title'],$blog['discription'],$unaccept,substr($blog['created_at'],0,10),substr($blog['updated_at'],0,10),$user,"<button type=button class='btn btn-sm btn-warning' onclick=accept1($blog[id],event)>$accept</button>"];
         }
       
        return response()
            ->json(['draw'=>$input['draw'],
                    'recordsTotal'=>$total ,
                    'recordsFiltered'=>$total ,
                    'data'=>$data,
                    'request'=>$input,
                    ]);
    }
}
