<?php

namespace App\Http\Controllers;

use App\Events\ViewPost;
use App\View;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Hekmatinasser\Verta\Verta;
use Cviebrock\EloquentTaggable\Taggable;


class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show','searchByTag','searchByCategory','search' ,'likePost']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //show all post
    {
        //$posts =  Post::all();
        //$post =  Post::where('title','post two')->get();
        //$posts =  Post::orderBy('title','desc')->get();
        //$posts =  Post::orderBy('title','desc')->take(1)->get();
        $posts =  Post::orderBy('created_at','desc')->paginate(10);
//        return $posts;

        return view('posts.index')->with('posts' , $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // return view for create a post
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // store a post in data base
    {

        $this->validate($request , [
           'title' => 'required',
           'body' => 'required',
           'cover_image' => 'image|nullable|max:1999',
            'category' => 'in:BLOG,NABZOGRAPHY,NEWS',
        ]);

        //handle file upload
        if ($request->hasFile('cover_image'))
        {
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt , PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }
        //get tags
        $tags = explode(',',$request->tags);
        //create post
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category = strtoupper($request->input('category'));
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        $post->tag($tags);

        return redirect('/posts')->with('success' , 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // show a post
    {
        $post = Post::find($id);
        $date = new Verta($post->created_at);
//        $ip = request()->ip();
//        $user_id = auth()->user()->id;
//        $viewCount = $post->view()->where('user_id' , '=' , $user_id)->where('post_id' , '=' , $id)->count();
//        if ($viewCount == 0)
//        {
//            $view = new View();
//            $view->ip = request()->ip();
//            $view->post_id = $id;
//            $view->user_id = $user_id;
//            $view->save();
//        }

        event(new ViewPost($post));
//        $views = $post->view()->count();
        return view('posts.show')->with(['post' => $post , 'date' => $date ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // return view for edit a post
    {
        $post = Post::find($id);

        if (auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error' , 'Unauthorized Page');
        }

        return view('posts.edit')->with('post' , $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // save change when updated a post
    {
        $this->validate($request , [
            'title' => 'required',
            'body' => 'required',
            'category' => 'in:BLOG,NABZOGRAPHY,NEWS',
        ]);

        if ($request->hasFile('cover_image'))
        {
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt , PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
        }

        //get tags
        $tags = explode(',',$request->tags);
        //update post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category = strtoupper($request->input('category'));
        if ($request->hasFile('cover_image'))
        {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        $post->retag($tags);

        return redirect('/posts')->with('success' , 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // delete a post
    {
        $post = Post::find($id);


        if (auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error' , 'Unauthorized Page');
        }

        if ($post->cover_image != 'noimage.jpg')
        {
            //Delete the image
            Storage::delete('public/cover_image/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success' , 'Post removed');
    }

    public function searchByTag($tag ,$category) /*با کلیک روی یک تگ تمام پست های دارای آن تگ که در همان دسته بندی پست سرچ شده هستند را برمیگرداند*/
    {
        //$posts =  Post::withAllTags($tag)->get();
        $posts =  Post::withAllTags($tag)->where('category',$category)->orderBy('created_at','desc')->paginate(10);
//        var_dump($posts);
        return view('posts.index')->with('posts' , $posts);

    }

    public function searchByCategory($category)/*همه پست ها با دسته بندی سرچ شده را برمیگرداند*/
    {
        $posts =  Post::orderBy('created_at','desc')->where('category',$category)->paginate(10);
//        var_dump($posts);
        return view('posts.index')->with('posts' , $posts);
    }

    public function search(Request $request)/*جستوجو تنها بر اساس تگ (بدون در نظر گرفتن دسته بندی)*/
    {
        $this->validate($request , [
            'search' => 'required',
        ]);

        $posts =  Post::withAllTags($request->search)->orderBy('created_at','desc')->paginate(10);
//        var_dump($posts);
        return view('posts.index')->with('posts' , $posts);
    }

    public function likePost(Request $request)/*افزودن لایک یا دیس لایک به یک پست*/
    {
        $post_id = $request['id'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);

        if (!$post){
            return null;
        }

        if ($is_like)
            $post->like++;

        else
            $post->dislike++;


        try{
            if ($post->save())
            {
                return 'success';
//                return $post_id;
            }
        }
        catch(\Exception $e){
            // do task when error
            return $e->getMessage();
            echo $e->getMessage();   // insert query
        }



    }
}
