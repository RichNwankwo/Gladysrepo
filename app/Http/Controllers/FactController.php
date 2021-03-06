<?php

namespace App\Http\Controllers;
use App\Commands\FactInserted;
use App\GladysApp\Transformers\FactTransformer;
use App\Models\Fact;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
class FactController extends ApiController
{

    /**
     * @var App\GladysApp\Transformers\FactTransformer
     */
    protected $factTransformer;

    function __construct(FactTransformer $factTransformer)
    {
        $this->factTransformer = $factTransformer;

        $this->middleware('auth.basic', ['only'=>'store']);
    }

    /**
     * Display a listing of the resource.
     * @param  FactGetRequest  $request
     * @return Response
     */
    public function index($user_id = null)
    {
        $facts = $this->getUserFacts($user_id);
        if(is_null($facts))
        {
           return $this->respondNotFound();
        }
        return $this->respond([
            'data' => $this->factTransformer->transformCollection($facts->toArray())]);
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
     * @param  $user_id user URI segment
     * @return Response
     */
    public function store(Request $request, $user_id = null)
    {

        if( ! $request->input('newFact'))
        {
            return $this->respondUnprocessed("Unprocessed: Please check data sent and try again");
        }
        else
        {
            $createdFact = Fact::create(['user_id' => $user_id, 'fact' => $request->input('newFact')]);
            $insert_id = $createdFact->id;
            // We need to do some other tasks like get questions for new fact
            $this->dispatch(new FactInserted(Auth::user(), $createdFact));
            $metadata = ['last_inserted_id' => $insert_id];
            return $this->respondCreated("Data successfully created", $metadata);
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
        $fact = Fact::find($id);
        if(!$fact)
        {
            return $this->respondNotFound('Item Not Found');
        }
        else
        {
            return $this->respond([
                'data' => [$this->factTransformer->transform($fact)]
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
        $fact = Fact::find($id);

        if( ! $fact)
        {
            return $this->respondNotFound();
        }


        $fact->fact = $request->input('newFact');
        $fact->save();
        return $this->respondCreated();

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
        $fact = Fact::find($id);
        $fact->taggedFact()->forceDelete();
        $fact->questions()->forceDelete();
        $fact->forceDelete();
        return $this->respondCreated();
    }

    /**
     * @param $user_id
     * @return null
     */
    protected function getUserFacts($user_id)
    {
        if(! is_null($user_id))
        {
            $user = User::find($user_id);
            $user ? $facts = $user->facts : $facts = null;
            return $facts;
        }

        $facts = Fact::all();
        return $facts;
    }
}
