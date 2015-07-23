<?php

namespace App\Http\Controllers;

use App\Models\No;
use App\GladysApp\Transformers\NoTransformer;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class NoController extends ApiController
{

    /**
     * @var App\NoApp\Transformers\NoTransformer
     */
    protected $noTransformer;

    function __construct(NoTransformer $noTransformer)
    {
        $this->noTransformer = $noTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index()
    {
        $nos = No::all();
        return response()->json([
            'data' => $this->noTransformer->transformCollection($nos->toArray())
        ], 200);
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

        $no = No::find($id);
        if( ! $no )
        {
           return $this->respondNotFound('Item not found');
        }
        else
        {
            return Response()->json([
                'data' => $this->noTransformer->transform($no)
            ], 200);
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

    private function transformCollection($nos)
    {
        return array_map([$this, 'transform'], $nos->toArray());
    }

    private function transform($no)
    {

    }
}
