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
use Psy\Util\Json;

class PracticeMaterialController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $user_id
     * @param $session_id
     * @param $material_id
     * @return Response
     */
    public function index(Request $request, $user_id, $session_id, $material_id)
    {
        //
        $sessionMaterial = $this->getMaterialForNextQuestion($request->input('tags'), $user_id, $session_id, $material_id);
        return $this->respond([
            'data' => [$sessionMaterial]
        ]);
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
     */
    public function store(Request $request, $user_id = null, $session_id = null, $material_id = null)
    {

        $valid = $this->validateSessionMaterial($user_id, $session_id, $material_id);
        // If the material validation fails for any reason
        if($valid == FALSE)
        {
            $message = "Unable to process session material. Please start a new session and try again";
            return $this->respondUnprocessed($message);
        }
        $answer = [
            'question_id' => $request->input('question_id'),
            'answer' => $request->input('answer'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // if we are unable to fill in an answer for the material we just answered
        if( ! $this->createMaterialAnswer($answer, $user_id, $session_id, $material_id))
        {
            $message = "Unable to save answer at this time.";
            return $this->respondUnprocessed($message);
        }

        $sessionMaterial = $this->getMaterialForNextQuestion($request->input('tags'), $user_id, $session_id, $material_id);
        return $this->respond([
            'data' => [$sessionMaterial]
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param $answer array post data
     * @param $user_id user id
     * @param $session_id session of material
     * @param $material_id
     * @internal param int $id
     * @return Response
     */

    protected function createMaterialAnswer(array $answer, $user_id, $session_id, $material_id)
    {
        $insertedAnswer = QuestionAnswer::create($answer);
        $this->dispatch(new QuestionHasBeenAnswered($insertedAnswer, $user_id, $session_id));
        $answer_id = $insertedAnswer->id;
        if($answer_id)
        {
            return $this->updateMaterialData($material_id, $answer_id);
        }
        else
        {
            return false;
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
     * @param $material_id
     * @param $insertedAnswer
     */
    protected function updateMaterialData($material_id, $answer_id)
    {
        // Get the material
        $material = PracticeMaterial::find($material_id);
        if($material)
        {
            // update answer
            $material->answer_id = $answer_id;
            // save
            $material->save();
            return TRUE;
        }
        else
        {
            return FALSE;
        }

    }

    /**
     * @param array $tags
     * @param $user_id
     * @param $session_id
     * @param $material_id
     * @internal param Request $request
     * @return bool|mixed
     */
    protected function getMaterialForNextQuestion($tags = null, $user_id, $session_id, $material_id)
    {
        $practiceSessionToolbox = new PracticeSessionToolbox($user_id, $session_id);

        if($tags)
        {
            $tags = json_decode($tags);
            $sessionMaterial = $practiceSessionToolbox->getSessionMaterial($tags);
        }
        else
        {
            $sessionMaterial = $practiceSessionToolbox->getSessionMaterial();
        }
        // Material id
        $material_id = PracticeMaterial::create($sessionMaterial)->id;
        $sessionMaterial['material_id'] = $material_id;

        return $sessionMaterial;
    }

    public function validateSessionMaterial($user_id, $session_id, $material_id)
    {
        $session = PracticeSession::find($session_id);
        if($session)
        {
            if($session->user_id == $user_id)
            {
                $material = PracticeMaterial::find($material_id);
                if($material)
                {
                    if($material->session_id == $session->id)
                    {
                        return TRUE;
                    }
                }
            }
        }
        return FALSE;



//        $session_id == $material->session_id
    }
}
