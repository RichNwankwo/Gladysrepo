<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use App\Models\PracticeSession;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PracticeMaterial;
use App\Models\QuestionAnswer;
use App\GladysApp\Domain\PracticeSessionToolbox;
use App\Commands\QuestionHasBeenAnswered;
class PracticeMaterialController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
     * @param Request $request
     * @param null $user_id
     * @param null $session_id
     * @param null $material_id
     * @return Response
     *     // TODO this would probably need a custom validator
     * // TODO This also needs to be cleaned up
     */
    // TODO also verify resources still belong to each other
    public function store(Request $request, $user_id = null, $session_id = null, $material_id = null)
    {
        $answer = [
            'question_id' => $request->input('question_id'),
            'answer' => $request->input('answer'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $insertedAnswer = QuestionAnswer::create($answer);
        $this->dispatch(new QuestionHasBeenAnswered($insertedAnswer, $user_id, $session_id));
        $material = PracticeMaterial::find($material_id);
        $material->answer_id = $insertedAnswer->id;
        $material->save();
        $practiceSessionToolbox = new PracticeSessionToolbox($user_id, $session_id);
        $sessionMaterial = $practiceSessionToolbox->getSessionMaterial();
        $material_id = PracticeMaterial::create($sessionMaterial)->id;
        $sessionMaterial['material_id'] = $material_id;
        return $this->respond([
            'data' => [$sessionMaterial]
        ]);

    }

    /**
     * Display the specified r  esource.
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
    public function destroy($id)
    {
        //
    }
}
