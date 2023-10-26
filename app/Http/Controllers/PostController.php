<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Inertia\Inertia;
use App\Models\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::select('id', 'user_id', 'title', 'body')
                ->with([
                    'categories' => function($query) {
                        $query->select('id', 'name');
                    }, 
                    'images', 
                    'user' => function($query) {
                        $query->select('id', 'name');
                    }
                ])
                ->get()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Posts/Create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $user = auth()->user();
    
    // ポストの基本情報の保存
    $post = new Post([
        'title' => $request->input('title'),
        'body' => $request->input('body'),
        'user_id' => $user->id
    ]);
    $post->save();

    // カテゴリーの情報の保存
    if ($request->has('categories')) {
        $post->categories()->attach($request->input('categories'));
    }

    // 複数の画像をCloudinaryにアップロード
    if ($request->has('images')) {
        foreach ($request->file('images') as $file) {
            $image_url = Cloudinary::upload($file->getRealPath())->getSecurePath();
            $post->images()->create(['image_url' => $image_url]);
        }
    }

    return redirect()->route('posts.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = $post->comments()->with('user')->get();
        $images = $post->images; // postモデルにimagesリレーションを追加する必要があります。
        return inertia('Posts/Show', ['post' => $post, 'comments' => $comments, 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepostRequest  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepostRequest $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
