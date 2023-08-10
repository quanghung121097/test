<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $data = [
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'name' => $request->name
        ];
        $user = $this->userService->create($data);
        if (!empty($user)) {
            return response(['success' => true, 'data' => $user]);
        } else {
            return response(['success' => false, 'message' => 'Có lỗi xảy ra vui lòng thử lại'], 500);
        }
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(auth('api')->user())->header('Authorization', $token);
    }

    public function logout()
    {
        if(auth('api')->user()){
            auth('api')->logout();
            return response()->json(['message' => 'đăng xuất thành công']);
        }
        return response()->json(['message' => 'Chưa đăng nhập']);
    }

    public function check()
    {
        if(auth('api')->user()){
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
