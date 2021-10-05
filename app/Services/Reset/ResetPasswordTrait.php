<?php


namespace App\Services\Reset;


use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait ResetPasswordTrait
{

    public function resetLink($user)
    {
        $email = $user->email;
        $this->deleteToken($email);
//        $this->setToken($user);
//        $token = $this->getToken($email);
        $token = $this->token($user);
        return $this->link($email, $token);
    }

    public function setToken($user)
    {
        /*return DB::transaction(function () use ($user){
            return DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $this->token($user),
                'created_at' => Carbon::now()
            ]);
        });*/
    }

    public function token($user)
    {
        return  app(PasswordBroker::class)->createToken($user);
    }

    /*public function getToken($email)
    {
        return DB::table('password_resets')->where('email', $email)->get();
    }*/

    public function deleteToken($email)
    {
        return DB::transaction(function () use($email){
            return DB::table('password_resets')->where('email', $email)->delete();
        });
    }


    public function link($email, $token)
    {
        return config('app.base_url'). '/password/reset/' . $token . '?email=' . urlencode($email);
    }
}
