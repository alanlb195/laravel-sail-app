<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData["name"],
            'email' => $validatedData["email"],
            'password' => bcrypt($validatedData["password"])
        ]);

        return response()->json(
            [
                "message" => "Usuario registrado correctamente"
            ],
            Response::HTTP_CREATED
        );
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ];

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(
                    [
                        'error' => 'Usuario o contraseña invalidos'
                    ],
                    Response::HTTP_UNAUTHORIZED
                );
            }
        } catch (JWTException) {
            return response()->json(
                [
                    'error' => 'No se pudo generar el token'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->respondWithToken($token);
    }



    public function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL()
        ]);
    }


    public function getAuthenticatedUser()
    {
        $user = auth('api')->user();
        return response()->json($user);
    }

    public function logout()
    {
        try {

            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);

            return response()->json(
                [
                    "message" => 'Sesion cerrada correctamente',
                ],
                Response::HTTP_OK
            );
        } catch (JWTException $e) {
            return response()->json(
                [
                    "message" => 'No se pudo cerrrar la sesion, el token no es valido',
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
