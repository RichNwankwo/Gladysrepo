<?php

namespace App\Http\Controllers;
use App\GladysApp\Transformers\TagTransformer;
use App\Models\Fact;
use App\Models\Tag;

use App\Models\TaggedFact;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected $tagTransformer;

    function __construct( TagTransformer $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }


    /**
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($factId = null)
    {
        $tags = $this->getTags($factId);
        if(is_null($tags))
        {
            return $this->respondNotFound();
        }
        else
        {
            return $this->respond([
                'data' => $this->tagTransformer->transformCollection($tags->toArray())
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @param URI int $fact_id
     * @return Response
     */
    // TODO NEEDS REFACTORING... maybe put this in another method or even controller (TagFactController?)
    // TODO What if we don't get a valid fact to create a tag
    // There has to be a better way to findOrReturnNull with finding by a column
    // TODO CREATE TESTS
    public function store(Request $request, $fact_id = null)
    {
        //
        if( ! $request->input('tag_name'))
        {
            return $this->respondUnprocessed();
        }
        else
        {
            $tag_name = $request->input('tag_name');
            $tag = Tag::where('tag_name', $tag_name)->count();
            if( ! $tag )
            {
                $tag = Tag::create(['tag_name' => $tag_name]);

            }
            else
            {
                $tag = Tag::where('tag_name', $tag_name);
            }
            if($fact_id)
            {
                TaggedFact::create(['fact_id' => $fact_id, 'tag_id' => $tag->id]);
                return $this->respondCreated();
            }
            else
            {
                return $this->respondCreated();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $tag = Tag::find($id);

        if( ! $tag )
        {
            return $this->respondNotFound();
        }
        else
        {
            return $this->respond([
                'data' => [$this->tagTransformer->transform($tag->toArray())]
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $factId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTags($factId)
    {
        if( ! is_null($factId))
        {
            $fact = Fact::find($factId);
            $fact ? $tags = $fact->tags : $tags = null;
        }
        else
        {
            $tags = Tag::all();
        }
        return $tags;
    }
}
