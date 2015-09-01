<?php

namespace App\Http\Controllers;

use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use App\GladysApp\Transformers\QuestionAnswerTransformer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuestionAnswerController extends ApiController
{
    /**
     * @var App\GladysApp\Transformers\FactTransformer
     */
    protected $questionAnswerTransformer;

    function __construct(QuestionAnswerTransformer $questionAnswerTransformer)
    {
        $this->questionAnswerTransformer = $questionAnswerTransformer;

//        $this->middleware('auth.basic', ['only'=>'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $facts = QuestionAnswer::all();
        return $this->respond([
            'data' => $this->questionAnswerTransformer->transformCollection($facts->toArray())]);
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
        if(! $request->input('answer'))
        {
            return $this->respondUnprocessed();
        }

        QuestionAnswer::create(['answer' => $request->input('answer'),
            'question_id' => $request->input('question_id'),
            'checked'=>$request->input('checked')]);

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
        $questionAnswer = QuestionAnswer::find($id);
        if(!$questionAnswer)
        {
            return $this->respondNotFound('Item Not Found');
        }

        return $this->respond([
            'data' => [$this->questionAnswerTransformer->transform($questionAnswer)]
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
