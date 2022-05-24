<?php


namespace App\Services\Generator;


use App\Models\Auth\User;
use Carbon\Carbon;

trait Username
{
    public function generateUserName($name)
    {
        $user_name = $this->generateRandomString(str_replace(' ', '', strtoupper($name).Carbon::now()->format('y')));
        $user_count = User::where('name', $user_name)->count();
        $numeric = $user_count + 1;
        if  ($user_count > 0) {
            $user_name = $user_name.'-'.$numeric;
        }
        return strtolower($user_name);
    }

    private function generateRandomString($string) {
        $characters = $string;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
