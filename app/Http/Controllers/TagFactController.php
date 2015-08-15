<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\TaggedFact;
use App\Models\Fact;
use App\Models\Tag;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class TagFactController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $taggedFacts = TaggedFact::all();

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
    public function store(Request $request, $user_id = null, $fact_id = null)
    {


        if( ! $request->input('tag_name'))
        {
            return $this->respondUnprocessed();
        }

        $fact = Fact::find($fact_id);
        if($user_id)
        {
            $authUser = Auth::ID();
            if($authUser !=  $user_id)
            {
                return $this->respondForbidden("Unauthorized: Must be logged to access endpoint");
            }
            if($fact->user_id != $user_id)
            {
                return $this->respondForbidden("Unauthorized: Verify you still have access to resource");
            }
        }

        if( ! $fact)
        {
            return $this->respondNotFound("Fact Not found");
        }
        else
        {
            $tag_name = $request->input('tag_name');
            $tag = Tag::firstOrCreate(['tag_name'=>$tag_name]);
            if($tag)
            {

                TaggedFact::create(['fact_id' => $fact_id, 'tag_id' => $tag->id]);
                $metadata = ['tag_id' => $tag->id];
                return $this->respondCreated("Request Successful", $metadata);
            }
            else
            {
                return $this->respondUnprocessed("Unable to tag the fact");
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
    public function destroy($fact_id, $tag_id)
    {
        $tagFactRow = TaggedFact::whereRaw("tag_id = '$tag_id' and fact_id = '$fact_id'")->first();
        $tagFactRow->forceDelete();
    }
}
