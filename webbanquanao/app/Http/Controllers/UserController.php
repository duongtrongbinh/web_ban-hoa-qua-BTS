<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleModel;
use App\Traits\StorageTraits;
use Illuminate\Support\Facades\Hash;
use DB;
use Log;
use View;




class UserController extends Controller
{
    protected $user;
    protected $role;
    protected $storageTraits;

    public function __construct(){
        $this->user = new User();
        $this->role = new RoleModel();
        $this->storageTraits = new StorageTraits();

    }
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listUser = $this->user->get();
        return view('dashboard.permissions.role.list',compact('listUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listRole = $this->role->get();
        return view('dashboard.permissions.role.add',compact('listRole'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
                $image = $this->storageTraits->storageTraitUploadMuity($request->image_avatar, 'user');
                $dataNewUser = $request->except('_token','role','image_avatar','password');
                $dataNewUser['image_avatar'] = $image['file_path'];
                $dataNewUser['name_avatar'] = $image['file_name'];
                $dataNewUser['password'] = Hash::make($request->password);
                $user = $this->user->create($dataNewUser);
                $user->roles()->attach($request->role);
            DB::commit();
            return redirect()->route('list_user');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = $this->user->find(auth()->user()->id);
        return view('dashboard.permissions.profile.list',compact('user'));

    }
    public function list()
    {
        $user = $this->user->find(auth()->user()->id);
        return view('dashboard.layout.header',compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->user->find($id);
        $listRole = $this->role->get();
        $roleOfUser = $user->roles;
        return view('dashboard.permissions.role.update',compact('user','listRole','roleOfUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = $this->user->find($id);
        $dataUpdateUser = $request->except('_token','image_avatar','_method');
        if((!$request->image_avatar) || ($request->image_avatar == $user->image_avatar)){
            $user->update($dataUpdateUser);
        }else{
            $image = $this->storageTraits->storageTraitUploadMuity($request->image_avatar, 'user');
            $dataUpdateUser['image_avatar'] = $image['file_path'];
            $dataUpdateUser['name_avatar'] = $image['file_name'];
            $user->update($dataUpdateUser);
        }
        return redirect()->route('profileUser');

    }

    public function updateRole(Request $request, string $id){
        try {
            DB::beginTransaction();

                $user = $this->user->find($id);
                $dataUpdateUser = $request->except('_token','image_avatar','_method','password','role');
                if((!$request->image_avatar) || ($request->image_avatar == $user->image_avatar)){
                    $user->update($dataUpdateUser);
                    $user->roles()->sync($request->role);

                }else{
                    $image = $this->storageTraits->storageTraitUploadMuity($request->image_avatar, 'user');
                    $dataUpdateUser['image_avatar'] = $image['file_path'];
                    $dataUpdateUser['name_avatar'] = $image['file_name'];
                    $user->update($dataUpdateUser);
                    $user->roles()->sync($request->role);
                }

            DB::commit();
            return redirect()->route('list_user');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->user->find($id)->delete();
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
