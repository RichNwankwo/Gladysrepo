<?php

namespace App\Http\Controllers;
use App\GladysApp\Transformers\TagTransformer;
use App\Models\Fact;
use App\Models\Tag;

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
            return $this->setStatusCode('404')->respondNotFound('Data not found');
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
     * @return Response
     */
    public function store(Request $request)
    {
        //
        if( ! $request->input('tag_name'))
        {
            return $this->setStatusCode('402')->respondWithError('Invalid Data Request');
        }
        else
        {
            Tag::create(['tag_name' => $request->input('tag_name')]);
            return $this->setStatusCode('200')->respond(['message'=> 'Tag successfully Stored']);
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
            return $this->setStatusCode('404')->respondNotFound('Data not found');
        }
        else
        {
            return $this->respond([
                'data' => $this->tagTransformer->transform($tag->toArray())
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
