<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    // masing masing method memiliki 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ambilkan data Post dimana user_id sama dengan user id yang sedang login
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // mengarahkan ke view create dan mengirimkan data category name
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  membuat post baru dengan validasi
    public function store(Request $request)
    {
        // laravel memiliki filesystem powerful bernama flysystem
        // filesystem.php untuk mengatur lokasi penyimpanan
        // dapat kita atur ke public agar dapat diakses
        // kemudian buat symbolic link dengan perintah
        // php artisan storage:link
        // kemudian untuk mengakses file dapat dilakukan dengan method
        // asset('path file terhadap public')
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        // jika ada image yang masuk, maka file image akan disimpan dalam post-images dan database
        // store mengembalikan path
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // mendapatkan userid dari user yang mengupload
        $validatedData['user_id'] = auth()->user()->id;

        //menggunakan string helper atau limit untuk memotong string panjang
        //strip_tags digunakan untuk menghilangkan format HTML pada editor trix
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200, '...');

        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New posts has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];


        //membandingkan slug request dan slug lama
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                // menghapus file image lama
                Storage::delete($request->oldImage);
            }
            //menyimpan image dan mengupload path ke database
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        Post::where('id', $post->id)
            ->update($validatedData);

        return redirect('dashboard/posts')->with('success', 'Posts has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            // mendelete file di storage
            Storage::delete($post->image);
        }

        // mendelete data di database
        Post::destroy($post->id);

        return redirect('dashboard/posts')->with('success', 'Posts has been deleted');
    }

    // menggenerate slug unik berdasarkan title 
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
