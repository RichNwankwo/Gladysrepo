<?php


namespace App\Http\Controllers;


use App\GladysApp\Transformers\UserTransformer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController {

    protected $UserTransformer;

    function __construct(userTransformer $UserTransformer)
    {
        $this->UserTransformer = $UserTransformer;
    }

    public function index()
    {
        if(Auth::check())
        {
            $user_id = Auth::id();
            $user = User::Find($user_id);
            return $this->respond([
                'data'=>[$this->UserTransformer->transform($user)]
            ]);
        }
        else
        {
            return $this->respondForbidden();
        }
    }

} 