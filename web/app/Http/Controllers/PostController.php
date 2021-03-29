<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

use App\Http\Resources\PostCollection;

use App\Models\Post;
use App\Models\Translation;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  PostResource::collection(Post::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tests.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'language_id'=>'required|integer',
             'title'=>'required|string',
             'description'=>'required|string',
             'content'=>'required|string',
             'tags'=>'regex:/^(\d+,)*\d+$/',
        ];

        $this->validate($request,$rules);

        $post = new Post;
        $post->save();

        $translation = new Translation(
            [
                'language_id'   => (int)$request->language_id,
                'title'         => $request->title,
                'description'   => $request->description,
                'content'       => $request->content,
                'translatable_id' => $post->id
            ]
        );

        $post->translations()->save($translation);

        if(isset($request->tags))
        {
            $tags = explode(',',$request->tags);
            foreach($tags as $one)
            {
                $post->tags()->attach($one);
            }
        }

        return new PostResource($post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PostResource(Post::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('tests.posts.edit');
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

        $rules=[
            'id'=>'required|integer',
            'language_id'=>'required|integer',
            'title'=>'string',
            'description'=>'string',
            'content'=>'string',
            'tags'=>'regex:/^(\d+,)*\d+$/',
        ];

        $this->validate($request,$rules);

        $post = Post::find($id);

        $translations = $post->translations;

        $translation_id = 0;

        foreach($translations as $translation)
        {
            if($translation->language_id == $request->language_id)
            {
                $translation_id = $translation->id;
                $t_model = Translation::find($translation_id);

                if(isset( $request->title ))
                    $t_model->title = $request->title;
                if(isset( $request->desctiption ))
                    $t_model->desctiption = $request->desctiption;
                if(isset( $request->content ))
                    $t_model->content = $request->content;

                $t_model->save();

            }
        }

        if($translation_id == 0)
        {
            $translation = new Translation(
                [
                    'language_id'   => (int)$request->language_id,
                    'title'         => $request->title,
                    'description'   => $request->description,
                    'content'       => $request->content,
                    'translatable_id' => $post->id
                ]
            );

            $post->translations()->save($translation);
        }

        if(isset($request->tags))
        {
            foreach($post->tags as $one)
                $post->tags()->detatch($one->id);

            $tags = explode(',',$request->tags);
            foreach($tags as $one)
                $post->tags()->attach($one);

        }

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->deleted_at = date('Y-m-d H:i:s');
        $post->save();

        return response()->json(['id'=>$id,'deleted'=> 1],200);
    }
}
