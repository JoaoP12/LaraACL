<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        if(Gate::denies('user'))
            return abort(405, 'Access Denied');
    }

    public function index(){
        $users = $this->user->all();
        
        return view('painel.users.index', compact('users'));
    }
    
    public function roles($id){
        $user = $this->user->find($id);
        
        $roles = $user->roles;
        
        return view('painel.users.roles', compact('user', 'roles'));

    }
}
