<?php

namespace App\Domain\Exception;

/**
 * Class InvalidLoginException
 * @package App\Domain\Exception
 */
final class InvalidLogin extends \DomainException
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
     * @return InvalidLogin
     */
    public static function withCredentials(string $email, string $plainPassword)
    {
        $static = new static();
        $static->email = $email;
        $static->plainPassword = $plainPassword;

        $static->message = sprintf('%s has failed to login', $email);

        return $static;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function plainPassword()
    {
        return $this->plainPassword;
    }
}
