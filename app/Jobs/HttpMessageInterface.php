<?php


namespace App\Jobs;


use Illuminate\Http\Request;

interface HttpMessageInterface
{

    public function BuildFromHttpRequest(Request $request);
}
