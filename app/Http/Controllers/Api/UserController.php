<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserResource::collection(User::paginate(2));
        return $users;
//        return response()->json(['users' => $users, 200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu',
                'errors' => $validator->errors()
            ], 422);
        }

        User::create([
            "id" => rand(0, 98974),
            "name" => $request->input("name"),
            "email" => $request->input("email"),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kaydedildi'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = new UserResource(User::find($id));
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::where('_id', $id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($user)
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu',
                'errors' => $validator->errors()
            ], 422);
        }

        $user->update([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Güncellendi'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::where("_id", $id)->first();
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Silindi'
        ]);
    }
}
