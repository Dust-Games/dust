<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\RefreshTokenRequest;
use Illuminate\Auth\Events\Registered;
use App\Jobs\RemoveOldTokens;
use App\Models\User;

class AuthController extends Controller
{

    public function register(RegisterRequest $req)
    {
        $data = $req->validated();

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        $response = $this->requestAccessToken(
            $data[$this->username()],
            $data['password'],
        );

        return response([
            'access_token' => $response['access_token'],
            'refresh_token' => $response['refresh_token'],
            'user' => new UserResource($user),
        ], 201);
    }

    public function login(LoginRequest $req)
    {
        $data = $req->validated();

        $user = User::where($this->username(), $data[$this->username()])->first();

        if ($this->checkPassword($data['password'], $user->getPassword())) {
            
            $time = (string) now();

            $response = $this->requestAccessToken(
                $data[$this->username()],
                $data['password']
            );

            if ($user->hasTooManyTokens()) {
                RemoveOldTokens::dispatch($user->getKey(), $time);
            }

            return response([
                'access_token' => $response['access_token'],
                'refresh_token' => $response['refresh_token'],
                'user' => new UserResource($user),
            ], 200);
        }

        return response(['error' => 'Wrong password. Please, try again.'], 422);
    }

    public function refreshToken(RefreshTokenRequest $req)
    {
        $refresh_token = $req->validated()['refresh_token'];

        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
        ];

        $resp = $this->makePostRequest($params);

        return [
            'access_token' => $resp['access_token'],
            'refresh_token' => $resp['refresh_token'],
        ];
    }

    public function username()
    {
        return 'email';
    }

    protected function requestAccessToken($username, $password)
    {
        $params = [
            'grant_type' => 'password',
            'username' => $username,
            'password' => $password,
        ];                

        return $this->makePostRequest($params);
    }

    protected function makePostRequest(array $params)
    {
        $all_params = array_merge(
            [
                'client_id' => config('services.passport.frontend_client_id'),
                'client_secret' => config('services.passport.frontend_client_secret'),
                'scope' => '*',
            ],
            $params
        );

        $response = Http::post(
            config('app.url') . '/oauth/token',
            $all_params,
        );

        info($response);

        return $response;
    }

    protected function checkPassword(string $password, string $hash)
    {
        return Hash::check($password, $hash);
    }
}