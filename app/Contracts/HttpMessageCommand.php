<?php

namespace App\Contracts;

use Illuminate\Http\Request;

/**
 * Interface HttpMessageCommand
 * @package App\Domain\Contracts
 */
interface HttpMessageCommand
{
    /**
     * @param Request $request
     * @return static
     */
    public static function createFromHttpRequest(Request $request);
}
