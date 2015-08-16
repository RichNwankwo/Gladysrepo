<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PracticeSession;
use App\GladysApp\Domain\PracticeSessionToolbox;
use Illuminate\Support\Facades\Auth;
use App\Commands\PracticeSessionStarted;
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
    public function store(Request $request, $user_id = null)
    {

        $authUser = Auth::ID();
        if($user_id != $authUser)
        {
            return  $this->respondUnauthorized('Unable to start session: Check authorization');
        }

        $this->dispatch(new PracticeSessionStarted(Auth::user()));
        $practice_session = PracticeSession::create(['user_id'=> $user_id, 'started_at'=> date('Y-m-d H:i:s')]);
        if($practice_session)
        {
            $practiceSessionToolbox = new PracticeSessionToolbox($user_id, $practice_session->id);
            return $this->respond([
                'data' => [$practiceSessionToolbox->getSessionMaterial()]
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
