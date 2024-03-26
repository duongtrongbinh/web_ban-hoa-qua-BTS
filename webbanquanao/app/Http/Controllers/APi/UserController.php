<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    
    public function logout(Request $request){
        $this->validate($request, [
            'allDevice' => 'required'
        ]);

        $user = Auth::user();
        if ($request->allDevice) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });
            return response(['message' => 'Bạn đã đăng xuất ra hết tất cả thiết bị !!'], 200);
        }

        $userToken = $user->token();
        $userToken->delete();
        return response(['message' => 'Bạn đã đăng xuất thành công !!'], 200);
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8'
        ], [
            "email.required" => "Vui lòng nhập email của bạn.",
            "email.unique" => "Địa chỉ email này đã tồn tại trên hệ thống.",
            "password.required" => "Vui lòng nhập password của bạn.",
            "email.email" => "Vui lòng nhập đúng định dạng email."

        ]);
        $login = $request->only('email','password');
        if(!Auth::attempt($login)){
            return response()->json([
                'message' => "đăng nhập thất bại."
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken($user->name);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image_avatar' => $user->image_avatar,
            'name_avatar' => $user->name_avatar,
            'password' => $user->password,
            'token' => $token->accessToken
        ], 200);
    }



    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'password' => 'required|min:7',
        ]
        , [
            "name.required" => "Vui lòng nhập name của bạn.",
            "email.required" => "Vui lòng nhập email của bạn.",
            "email.unique" => "Địa chỉ email này đã tồn tại trên hệ thống.",
            "password.required" => "Vui lòng nhập password của bạn.",
            "email.email" => "Vui lòng nhập đúng định dạng email."

        ]);
        $exists = User::where('email', $request->email)->exists();
        if(!$exists){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image_avatar' =>'anhdaidien.png',
            'name_avatar' =>'anhdaidien',
            'phone' => '0123456789',
            'address' => 'No',
            'birthday' => Carbon::now(),
            'desc'=>'No'
        ]);
        if($user){
        $user->roles()->attach(3);
            return response()->json(['message1' => 'Bạn đã đăng ký tài khoản thành công.'], 200);
        }else{
            return response()->json(['message2'=> 'Đăng ký thát bại'], 401);
        }
    }else{
        return response()->json(['message3'=> 'Email đã đăng ký với trang web.'], 401);
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json($user,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
