<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PracticeSession;
use App\GladysApp\Domain\PracticeSessionToolbox;
use Illuminate\Support\Facades\Auth;
use App\Commands\PracticeSessionStarted;
use App\Models\PracticeMaterial;
class PracticeSessionController extends ApiController
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
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    //TODO clean up this code
    public function store(Request $request, $user_id = null)
    {

        $this->dispatch(new PracticeSessionStarted(Auth::user()));
        $practice_session = PracticeSession::create(['user_id'=> $user_id, 'started_at'=> date('Y-m-d H:i:s')]);
        if($practice_session)
        {
            $practiceSessionToolbox = new PracticeSessionToolbox($user_id, $practice_session->id);
            $sessionMaterial = $practiceSessionToolbox->getSessionMaterial();
            if( ! $sessionMaterial)
            {
                return $this->respondNotFound('Unable to start session. Make sure you have facts with questions! Call!');
            }
            $material_id = PracticeMaterial::create($sessionMaterial)->id;
            $sessionMaterial['material_id'] = $material_id;
            return $this->respond([
                'data' => [$sessionMaterial]
            ]);
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
     * @param $session_id
     * @param $session_type
     * @return Response
     * @internal param int $id
     */
    public function edit($user_id, $session_id, $session_type)
    {
        $practiceSession = PracticeSession::find($session_id);
        if( ! $practiceSession)
        {
            return $this->respondNotFound('Unable to find session');
        }

        $practiceSession->session_type = $session_type;
        $practiceSession->save();
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
