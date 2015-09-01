<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\GladysApp\Transformers\QuestionTransformer;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB as DB;

class QuestionController extends ApiController
{
    protected $questionTransformer;

    function __construct(QuestionTransformer $questionTransformer)
    {
        $this->questionTransformer = $questionTransformer;

//        $this->middleware('auth.basic', ['only'=>'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $facts = Question::all();
        return $this->respond([
            'data' => $this->questionTransformer->transformCollection($facts->toArray())]);
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
        if(! $request->input('question_title') || !$request->input('question_type'))
        {
            return $this->respondUnprocessed();
        }
        Question::create(['question_title' => $request->input('question_title'),
            'question_type' => $request->input('question_type'),
            'fact_id' => $request->input('fact_id')]);
        return $this->respondCreated("Data successfully created");

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
        $question = Question::find($id);
        if(!$question)
        {
            return $this->respondNotFound('Item Not Found');
        }
        return $this->respond([
            'data' => [$this->questionTransformer->transform($question)]
        ]);


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
