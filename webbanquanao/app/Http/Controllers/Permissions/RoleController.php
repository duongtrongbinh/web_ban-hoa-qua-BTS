<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\UserRoleModel;

class RoleController extends Controller
{
    protected $role;
    protected $user_role;
    public function __construct(){
        $this->role = new RoleModel();
        $this->user_role = new UserRoleModel();
    }

    public function index(){

    }

    public function create(Request $request){
        
    }

    public function store(){
        
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
