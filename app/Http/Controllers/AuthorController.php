<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Blog;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('author.index', ['name' => 'Samantha']);
    }
    public function blog()
    {
        return view('author.blog.index');
    }
    public function edit(Request $request)
    {
        $input=$request->all();
        $blog="";
        if(!empty($input['id'])){
        $blog = \App\Blog::find($input['id']);
        }
        return view('author.blog.edit', ['blog' =>$blog]);
    }
      public function store(Request $request)
    {
        if(empty($request->title))
            $request->title="no title";
        // Validate the request...
        if(empty($request->id)){
        $blog =new \App\Blog;

        $blog->title = $request->title;
        $blog->discription = $request->description;
        $blog->author_id = Auth::id();
        $blog->accept=0;

        $blog->save();}
        else{
            $blog = \App\Blog::find($request->id);

            $blog->title = $request->title;
           $blog->discription = $request->description;

            $blog->save();
        }
        return redirect()->route('blog');
    }
    public function delete(Request $request)
    {
        $input=$request->all();
        $blog = \App\Blog::find($input['id']);
        $blog->delete();
        return response()
            ->json(['success'=>'true'
                    
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
        $array=['id','title','discription','accept','created_at','updated_at'];
        $id = Auth::id();
        $blogs = \App\Blog::where('author_id', $id);
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
        $total= \App\Blog::where('author_id', $id);
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
            $accept=$blog['accept']=="0"?"wait":"accepted";
            $data[]=[$blog['id'],$blog['title'],$blog['discription'],$accept,substr($blog['created_at'],0,10),substr($blog['updated_at'],0,10),"<a href=".route('edit_blog',['id'=>$blog['id']])."><button type='button' class='btn btn-sm btn-primary'>Edit</button></a><button type=button class='btn btn-sm btn-warning' onclick=delete1($blog[id])>Delete</button>"];
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
