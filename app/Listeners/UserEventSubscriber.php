<?php

namespace App\Listeners;

use App\Models\Token\UserLoginToken;
use App\Repositories\Access\UserLogRepository;
use App\Repositories\System\CodeValueRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

/**
 * Class UserEventSubscriber
 * @package App\Listeners
 */
class UserEventSubscriber
{
    /**
     * @var
     */
    public $userLog;

    /**
     * @var
     */
    public $agent;

    /**
     * @var
     */
    public $codeValue;

    /**
     * UserEventSubscriber constructor.
     */
    public function __construct()
    {
        $this->userLog = new UserLogRepository();
        $this->agent = new Agent();
        $this->codeValue = new CodeValueRepository();
    }

    public function createLogData($data)
    {
        $browser = $this->agent->browser();
        $version = $this->agent->version($browser);
        $platform = $this->agent->platform();
        $platform_version = $this->agent->version($platform);
        $data = array_merge(
            $data,
            [
                'has_remember' => (access()->viaRemember()) ? 't' : 'f',
                'browser' => $browser,
                'browser_version' => $version,
                'device' => $this->agent->device(),
                'platform' => $platform,
                'platform_version' => $platform_version,
                'isdesktop' => ($this->agent->isDesktop()) ? 't' : 'f',
                'isphone' => ($this->agent->isPhone()) ? 't' : 'f',
                'isrobot' => ($this->agent->isRobot()) ? 't' : 'f',
                'ismobile' => ($this->agent->isMobile()) ? 't' : 'f',
                'istablet' => ($this->agent->isTablet()) ? 't' : 'f',
                'robot_name' => $this->agent->robot(),
            ]
        );
        $this->userLog->query()->create($data);
    }

    /**
     * Handle user login event.
     */
    public function onUserLogin($event)
    {
        $data = ['user_id' => $event->user->id, 'user_log_cv_id' => $this->codeValue->getUserLogTypeLogIn()];
        $this->createLogData($data);
        $this->storeUserToken();
        //Save this login
        $user = $event->user;
        $user->last_login = Carbon::now();
        $user->save();
    }

    /**
     * Handle user logout event.
     */
    public function onUserLogout($event)
    {
        $data = ['user_id' => $event->user->id, 'user_log_cv_id' => $this->codeValue->getUserLogTypeLogOut()];
        $this->createLogData($data);
        $this->updateUserToken($event->user->loginToken->uuid);
    }

    /**
     * Handle user failed login event.
     */
    public function onUserFailed($event)
    {
        if ($event->user) {
            $data = ['user_id' => $event->user->id, 'user_log_cv_id' => $this->codeValue->getUserLogTypeFailedLogin()];
            $this->createLogData($data);
        }
    }

    /**
     * Handle user lockout event.
     */
    public function onUserLockout($event)
    {
        $data = ['username' => $event->request->username, 'user_log_cv_id' => $this->codeValue->getUserLogTypeUserLockout()];
        $this->createLogData($data);
    }

    /**
     * Handle user attempting to reset password event.
     */
    public function onUserPasswordReset($event)
    {
        $data = ['user_id' => $event->user->id, 'user_log_cv_id' => $this->codeValue->getUserLogTypePasswordReset()];
        $this->createLogData($data);
    }

    /**
     * Handle user registration success event.
     */
    public function onUserRegistered($event)
    {

    }

    public function storeUserToken()
    {
        UserLoginToken::query()->create([
            'user_id'=>access()->id(),
            'token'=>Str::random(64),
            'session_time'=>90,

        ]);
    }
    public function updateUserToken($uuid)
    {
        UserLoginToken::query()->where('uuid', $uuid)->update([
            'valid'=>false
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );

        $events->listen(
            'Illuminate\Auth\Events\Failed',
            'App\Listeners\UserEventSubscriber@onUserFailed'
        );

        $events->listen(
            'Illuminate\Auth\Events\Lockout',
            'App\Listeners\UserEventSubscriber@onUserLockout'
        );

        $events->listen(
            'Illuminate\Auth\Events\PasswordReset',
            'App\Listeners\UserEventSubscriber@onUserPasswordReset'
        );

        $events->listen(
            'Illuminate\Auth\Events\Registered',
            'App\Listeners\UserEventSubscriber@onUserRegistered'
        );

    }

}
