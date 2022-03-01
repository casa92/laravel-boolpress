<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\While_;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        $request->validate($this->getValidate());

        $new_post = new Post();
        $new_post->fill($form_data);

        // $new_post->slug = $this->getUniqueSlug($form_data['title']);
        $new_post->slug = Post::getUniqueSlug($form_data['title']);
        
        $new_post->save();

        // salvo le ralazioni di tags
       if(isset($form_data['tags'])) {
            $new_post->tags()->sync($form_data['tags']);
       }


        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form_data = $request->all();

        $request->validate($this->getValidate());

        $post = Post::findOrFail($id);

        // lo slug viene aggiornato solo se viene modificato il titolo
        if ($form_data['title'] != $post->title) {

            // $form_data['slug'] = $this->getUniqueSlug($form_data['title']);
            $form_data['slug'] = Post::getUniqueSlug($form_data['title']);

        }

        $post->update($form_data);

        // se non esistono tags in form data significa che sono stati rimosse tutte le spunte dall'utente
        if(isset($form_data['tags'])) {
            $post->tags()->sync($form_data['tags']);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->tags()->sync([]);

        $post->delete();

        return redirect()->route('admin.posts.index');
    }


    // FUNZIONI
    //validazione
    protected function getValidate() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'exists:categories,id',
            'tags' => 'exists:tags,id'
        ];
    }

    // //crea slug unico con finale progressivo (-1,-2,-3,..)
    // protected function getUniqueSlug($title) {
    //     $slug = Str::slug($title);
    //     $slug_basic = $slug;

    //     $post_found = Post::where('slug', '=', $slug)->first();
        
    //     $counter = 1;
    //     while ($post_found) {
    //         $slug = $slug_basic . '-' . $counter;
    //         $post_found = Post::where('slug', '=', $slug)->first();
    //         $counter++;
    //     }

    //     return $slug;
    // }
}
