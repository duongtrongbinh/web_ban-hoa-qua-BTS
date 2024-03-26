<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidationWeb;
use App\Jobs\SendMembershipEmailJob;
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
        $listUser = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'guest');
        })->paginate(20);
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

    public function createGuest()
    {
        return view('dashboard.admin.guests.add');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(UserValidationWeb $request)
    {
        try {
            DB::beginTransaction();
                $dataNewUser = $request->except('_token','filepath','password','ag');
                $dataNewUser['image_avatar'] = $request->filepath;
                $dataNewUser['name_avatar'] = basename($request->filepath);
                $dataNewUser['password'] = Hash::make($request->password);
                $user = $this->user->create($dataNewUser);
                $user->roles()->attach($request->role);
                $dataNewUser['password'] = $request->input('password');
                foreach ($request->input('role') as $key ) {
                    $dataNewUser['role'] =[RoleModel::where('id', $key)->value('name')];  
                }
            DB::commit();
            if($request->ag !== 'g'){
                dispatch(new SendMembershipEmailJob($dataNewUser))->delay(now()->addMinutes(1));
                return redirect()->route('list_user');
            }else{
                return redirect()->route('list_member');
            }
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
    public function showGuest()
    {
        $guestUsers = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'guest');
        })->paginate(20);
        return view('dashboard.admin.guests.guest',compact('guestUsers'));

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
        $user = $this->user->where('id',$id)->first();
        $listRole = $this->role->get();
        $roleOfUser = $user->roles;
        return view('dashboard.permissions.role.update',compact('user','listRole','roleOfUser'));
    }

    public function editGuest(string $id)
    {
        $user = $this->user->where('id',$id)->first();
        return view('dashboard.admin.guests.update',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserValidationWeb $request, string $id)
    {
        $user = $this->user->find($id);
        $dataUpdateUser = $request->except('_token','filepath','_method','role');
        if((!$request->filepath) || ($request->filepath == $user->image_avatar)){
            $user->update($dataUpdateUser);
        }else{
            $dataUpdateUser['image_avatar'] = $request->filepath;
            $dataUpdateUser['name_avatar'] = basename($request->filepath);
            $user->update($dataUpdateUser);
        }
        return redirect()->route('profileUser');

    }

    public function updateRole(UserValidationWeb $request, string $id){
        try {
            DB::beginTransaction();
                $user = $this->user->find($id);
                $dataUpdateUser = $request->except('_token','filepath','_method','password','role','ag');
                if($request->filepath == $user->image_avatar){
                    $user->update($dataUpdateUser);
                    $user->roles()->sync($request->role);
                }else{
                    // $image = $this->storageTraits->storageTraitUploadMuity($request->image_avatar, 'user');
                    $dataUpdateUser['image_avatar'] = $request->filepath;
                    $dataUpdateUser['name_avatar'] = basename($request->filepath);
                    $user->update($dataUpdateUser);
                    $user->roles()->sync($request->role);
                }

            DB::commit();
            if($request->ag !== 'g'){
                return redirect()->route('list_user');
            }else{
                return redirect()->route('list_member');
            }
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
