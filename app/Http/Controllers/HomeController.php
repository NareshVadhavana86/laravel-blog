<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tags = Tag::all(['id', 'name']);
        return view('home', ["tags" => $tags]);
    }

    /**
     * Store blog in database.
     *
     */
    public function storeBlog(StoreBlogRequest $request)
    {

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $blog = new Blog();
        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->image = $imageName;

        if($blog->save()) {
          return response()->json([
              'isSuccess' => true,
              'code' => 'blog_store_success',
              'message' => trans('blog.success.create')
          ], 200);
        }
    }

    public function blogs(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('image', function($row){
                        $url= asset('images/'.$row->image);
                        return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                    })
                    ->addColumn('action', function($row){
                        $url =
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['image', 'action'])
                    ->make(true);
        }

        return view('blogsList');
    }
}
