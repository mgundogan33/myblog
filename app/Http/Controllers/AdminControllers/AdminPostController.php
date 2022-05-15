<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPostController extends Controller
{
    private $rules = [
        'title' => 'required|max:200',
        'slug' => 'required|max:200',
        'excerpt' => 'required|max:300',
        'category_id' => 'required|numeric',
        'thumbnail' => 'required|file|mimes:jpg,png,webp,svg',
        'body' => 'required'
    ];
    public function index()
    {
        return view('admin_dashboard.posts.index', [
            'posts' => Post::with('category')->get(),
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.posts.create', [
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $post = Post::create($validated);

        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $post->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }
        $tags = explode(',', $request->input('tags'));
        $tags_ids = [];
        foreach ($tags as $tag) {
            $tag_ob = Tag::create(['name' => $tag]);
            $tags_ids[] = $tag_ob->id;
        }
        if (count($tags_ids) > 0)
            $post->tags()->sync($tags_ids);
        return redirect()->route('admin.posts.create')->with('success', 'Post has ben created');
    }

    public function show()
    {
    }
    public function edit(Post $post)
    {
        $tags = '';
        foreach ($post->tags as $key => $tag); {
            $tags .= $tag->name;
            if ($key !== count($post->tags) - 1)
                $tags .= ', ';
        }


        return view('admin_dashboard.posts.edit', [
            'post' => $post,
            'tags' => $tags,
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $this->rules['thumbnail'] = 'nullable|file|mimes:jpg,png,webp,svg,jpeg|jpeg,dimensions:max_width=400,max_height=350';
        $validated = $request->validate($this->rules);

        $post->update($validated);

        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $post->image()->update([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }
        $tags = explode(',', $request->input('tags'));
        $tags_ids = [];
        foreach ($tags as $tag) {
            $tag_ob = Tag::create(['name' => $tag]);
            $tags_ids[] = $tag_ob->id;
        }
        if (count($tags_ids) > 0)
            $post->tags()->sync($tags_ids);

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post has ben updated');
    }

    public function destroy(Post $post)
    {
        $post->tags()->delete();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post has been Deleted.');
    }
}
