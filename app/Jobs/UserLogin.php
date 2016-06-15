<?php

namespace App\Jobs;

use App\Contracts\HttpMessageCommand;
use App\Domain\Events\UserLoginWasFailed;
use App\Domain\Events\UserLoginWasSucceeded;
use App\Domain\Exception\InvalidLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserLogin extends Job implements ShouldQueue, HttpMessageCommand
{
    use InteractsWithQueue, SerializesModels, ThrottlesLogins;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var bool $remember
     */
    private $remember;

    /**
     * @var Request $request
     */
    private $request;

    /**
     * @param Request $request
     * @return UserLogin
     */
    public static function createFromHttpRequest(Request $request)
    {
        $static = new static();

        $static->email = $request->email;
        $static->password = $request->password;
        $static->remember = false;
        $static->request = $request;

        return $static;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Dispatcher $dispatcher)
    {
        if ( ! \Auth::guard('web')->attempt(
            [
                'email' => $this->email,
                'password' => $this->password,
            ],
            $this->remember
        )
        ) {

            $dispatcher->fire(UserLoginWasFailed::withCredentials($this->email, $this->password));

            throw InvalidLogin::withCredentials($this->email, $this->password);
        }

        $this->clearLoginAttempts($this->request);

        $dispatcher->fire(UserLoginWasSucceeded::withEmail($this->email));
    }
}
