<?php

namespace App\Repositories\LoginTokenRepository;

use App\Models\Token\UserLoginToken;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserLoginTokenRepository extends  BaseRepository
{
    const MODEL = UserLoginToken::class;
    public function __construct()
    {
        //
    }

    public function verifyToken($token)
    {
        $this->query()->where('token', $token)->first();
    }
    public function update($token)
    {
        $this->query()->where('token', $token)->update([
            'valid'=>true
        ]);
    }

    public function getUserDetails()
    {
        return $this->query()->select([
            DB::raw("concat_ws(' ', users.first_name, users.last_name) as full_name"),
            DB::raw("user_login_tokens.user_id AS user_id"),
            DB::raw("user_login_tokens.token AS token "),
            DB::raw("user_login_tokens.valid AS valid"),
            DB::raw("user_login_tokens.session_time AS session_time"),
            DB::raw("user_login_tokens.uuid AS uuid"),
            DB::raw("user_login_tokens.created_at AS created_at"),
        ])
            ->join('users','users.id','user_login_tokens.user_id');
    }

    public function getUserDetailsByToken($token)
    {
        return $this->getUserDetails()
            ->where('user_login_tokens.token', $token);
    }
}
