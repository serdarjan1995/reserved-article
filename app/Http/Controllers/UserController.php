<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserDetailResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $users = User::paginate(10);

        if (Str::startsWith($request->route()->getPrefix(),'api')){
            return UserResource::collection($users);
        }
        else{
            return Inertia::render('Users', ['users' => $users]);
        }

    }

    public function get(Request $request, $id)
    {
        $user = User::where(['id' => $id])->first();
        if (!$user){
            if (Str::startsWith($request->route()->getPrefix(),'api')){
                return response()->json(['status' => 'not found'], 404);
            }
            else{
                $request->session()->flash('type', 'danger');
                $request->session()->flash('title', 'ERROR:');
                $request->session()->flash('message', 'User not found');
                return redirect()->route('users.list');
            }
        }

        if (Str::startsWith($request->route()->getPrefix(),'api')){
            return new UserDetailResource($user);
        }
        else{
            return Inertia::render('UserDetail', ['userDetail' => new UserDetailResource($user)]);
        }
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $user->update($request->only(['name', 'email']));
        return new UserResource($user);
    }

    public function loginToken(Request $request){
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            foreach ($user->tokens as $token) {
                $token->delete();
            }
            $token = $user->createToken($user->id . '_token');
            return response()->json([
                'status' => 'success',
                'error_message' => null,
                'token' => $token->plainTextToken
            ], 200);
        }
        return response()->json(['status' => 'error', 'error_message' => 'login failed'], 401);
    }
}
