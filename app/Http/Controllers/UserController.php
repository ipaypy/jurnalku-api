<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
     public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'Not Found'], 404);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nis' => 'required|integer',
            'rombel' => 'required|string',
            'rayon' => 'required|string',
            'image' => 'nullable|string',
            'grade' => 'required|in:X,XI,XII',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $user = User::create($data);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'Not Found'], 404);

        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => "email|unique:users,email,{$id}",
            'password' => 'nullable|string|min:6',
            'nis' => 'integer',
            'rombel' => 'string',
            'rayon' => 'string',
            'image' => 'nullable|string',
            'grade' => 'in:X,XI,XII',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (isset($data['password']) && $data['password'] !== '') {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'Not Found'], 404);

        $user->delete();

        return response()->json(['message' => 'deleted']);
    }
}
