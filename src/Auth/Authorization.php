<?php

namespace Woweb\Openzaak\Auth;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;


class Authorization 
{
    /**
     * Get the JWT token to Authorize the request
     *
     * @return string
     */
    public static function getToken() : string
    {
        $user = Auth::user();

        if (!config('openzaak.user_jwt', true)) {
            return self::generateNewToken($user, false);
        }

        if(!empty($user->openzaak_jwt) && Carbon::parse($user->openzaak_jwt_valid_till) > Carbon::now()) {
            return $user->openzaak_jwt;
        } else {
            return self::generateNewToken($user);
        }
    }

    /**
     * Generates a new JWT token and saves it
     *
     * @param User|null $user
     * @return string
     */
    private static function generateNewToken(?User $user, bool $persist = true) : string
    {
        $clientId = config('openzaak.client_id');
        $clientSecret = config('openzaak.client_secret');
        $userId = 'application';
        $userName = 'Application background task';

        if($user instanceof User) {
            $userId = $user->uuid;
            $userName = $user->name;
        }

        if($clientId && $clientSecret) {
            $payload = [
                'iss'                   => $clientId,
                'iat'                   => Carbon::now()->timestamp,
                'client_id'             => $clientId,
                'user_id'               => $userId,
                'user_representation'   => $userName
            ];

            $token = 'Bearer ' . self::buildJwt($payload, $clientSecret);

            if ($persist) {
                self::updateUser($user, $token);
            }

            return $token;
        } else {
            throw new Exception('Client information (id / secret) is missing, did you added this information to the .env file?');
        }
    }

    /**
     * Updates User with new token and valid timestamp if a user is passed to the method
     *
     * @param User|null $user
     * @param string $token
     * @return void
     */
    private static function buildJwt(array $payload, string $secret) : string
    {
        $encode = fn($data) => rtrim(strtr(base64_encode($data), '+/', '-_'), '=');

        $header    = $encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
        $body      = $encode(json_encode($payload));
        $signature = $encode(hash_hmac('sha256', "$header.$body", $secret, true));

        return "$header.$body.$signature";
    }

    private static function updateUser(?User $user, string $token)
    {
        if($user instanceof User) {
            $user->openzaak_jwt = $token;
            $user->openzaak_jwt_valid_till = Carbon::now()->addHour()->toDateTimeString();
            $user->save();
        }
    }
}