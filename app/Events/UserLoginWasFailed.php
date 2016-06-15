<?php
declare(strict_types=1);

namespace App\Domain\Events;

use App\Events\Event;
use ValueObjects\Web\EmailAddress;

/**
 * Class UserLoginWasFailed
 * @package App\Domain\Events
 */
final class UserLoginWasFailed extends Event
{
    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @param string $email
     * @param string $plainPassword
     * @return UserLoginWasFailed
     */
    public static function withCredentials(string $email, string $plainPassword)
    {
        $static = new static();

        $static->email = $email;
        $static->plainPassword = $plainPassword;

        return $static;
    }
}
