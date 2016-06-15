<?php

namespace App\Jobs;

use App\Events\UserWasAdded;
use App\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddUserCommand extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var string $name ;
     */
    private $name;

    /**
     * @var string email
     */
    private $email;

    /**
     * @var string password
     */
    private $password;

    /**
     * @var string role;
     */
    private $role;

    /**
     * @var string description
     */
    private $description;

    /**
     * Create a new job instance.
     * @var Request $request
     */

    public static function createFromHttpRequest(Request $request)
    {
        $static = new static();
        $static->name = $request->name;
        $static->email = $request->email;
        $static->password = $request->password;
        $static->role = $request->role;
        $static->description = $request->description;

        return $static;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Dispatcher $dispatcher)
    {

        //
        \DB::transaction(function () {
            $newUser = User::createUserWithData(
                $this->name,
                $this->email,
                $this->password,
                $this->role,
                $this->description
            );
            $newUser->save();
        });

        $dispatcher->fire(new UserWasAdded(), []);
    }
}
