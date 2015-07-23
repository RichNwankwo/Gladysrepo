<?php

namespace App\Http\Controllers;
use App\GladysApp\Transformers\FactTransformer;
use App\Models\Fact;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class FactController extends ApiController
{

    /**
     * @var App\GladysApp\Transformers\FactTransformer
     */
    protected $factTransformer;

    function __construct(FactTransformer $factTransformer)
    {
        $this->factTransformer = $factTransformer;

        $this->middleware('auth.basic',['only'=>'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $facts = Fact::all();
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
     * @return Response
     */
    public function store(Request $request)
    {
        //
        if(! $request->input('fact'))
        {
            return $this->respond()
        }
        else
        {
            return $this->respond()
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
                'data' => $this->factTransformer->transform($fact)
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
}
