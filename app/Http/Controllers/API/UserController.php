<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\Middleware;



class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
{
  return [
  new Middleware(middleware:'auth:api',except:['index','show']),
  ];
}
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit =$request->input('limit') <= 50 ? $request->input('limit') :15;
        $user = UserResource::collection(User::paginate($limit));
        return $user->response()->setStatusCode(200, "User Returned Succefully");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',User::class);
        $user = new UserResource( User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]));
        return $user->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = new UserResource(User::findOrFail($id));
        return $user->response()->setStatusCode(200, "User Returned Succefully")
        ->header('Additional Header', 'Ture');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $iduser = User::findOrFail($id);
        $this->authorize('update', $iduser);
        $user = new UserResource(User::findOrFail($id));
        $user->update($request->all());

        return $user->response()->setStatusCode(200, "User Updated Succefully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);
            User::findOrFail($id)->delete;
            return 204;
    }
}
