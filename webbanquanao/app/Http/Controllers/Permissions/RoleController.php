<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\PermissionsModel;
use App\Conponents\Recusives;
use Illuminate\Support\Str;
use DB;
use Log;


class RoleController extends Controller
{
    protected $role;
    protected $permission;
    public function __construct(){
        $this->role = new RoleModel();
        $this->permission = new PermissionsModel();
    }

    public function getPermission($parentid){
        $data = $this->permission->all();
        $recusive = new Recusives($data);
        $htmlSelect = $recusive->categoryRecusive($parentid);
        return $htmlSelect;
    }


    public function index(){
        $role = $this->role->get();
        return view('dashboard.permissions.permission.list',compact('role'));
    }

    public function createPer(){
        $htmlSelect = $this->getPermission($parentid = "");
        return view('dashboard.permissions.permission.addPer',compact('htmlSelect'));
    }

    public function storePer(Request $request){
        $this->permission->create([
            'name'=> $request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
         ]);
        return redirect()->route('list_role');
    }

    public function create(){
        $permission = $this->permission->where('parent_id',0)->get();
        return view('dashboard.permissions.permission.add',compact('permission'));
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $data = $request->only(['name','display_name']);
            $data['slug']= Str::slug($request->name);
            $role = $this->role->create($data);
            $role->permissionRole()->attach($request->permisson);
            DB::commit();
            return redirect()->route('list_role');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }

    public function edit(string $id){
        $role = $this->role->find($id);
        $permission = $this->permission->where('parent_id',0)->get();
        $rolePer = $role->permissionRole;
        return view('dashboard.permissions.permission.update',compact('permission','role','rolePer'));
    }

    public function update(Request $request,string $id){
        try {
            $role = $this->role->find($id);
            DB::beginTransaction();
            $data = $request->only(['name','display_name']);
            $data['slug']= Str::slug($request->name);
            $role->update($data);
            $role->permissionRole()->sync($request->permisson);
            DB::commit();
            return redirect()->route('list_role');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }

    public function destroy(string $id){
        try {
            $this->role->find($id)->delete();
                    return response()->json([
                        'code' => 200,
                        "message" => "success"
                    ], 200);
                } catch (\Exception $exception) {
                    Log::error("message: " . $exception->getMessage());
                    return response()->json([
                        'code' => 500,
                        "message" => "false"
                    ], 500);
                }
    }
}
