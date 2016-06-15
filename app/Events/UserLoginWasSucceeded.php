<?php
declare(strict_types=1);

namespace App\Domain\Events;

use App\Events\Event;
use ValueObjects\Web\EmailAddress;

/**
 * Class UserLoginWasSucceeded
 * @package App\Domain\Events
 */
final class UserLoginWasSucceeded extends Event
{
    /**
     * @var string $email
     */
    private $email;

    /**
     * @param string $email
     * @return UserLoginWasSucceeded
     */
    public static function withEmail(string $email)
    {
        $static = new static();

        $static->email = $email;

        return $static;
    }

    /**
     * @return EmailAddress
     */
    public function email()
    {
        $this->email;
    }
}
