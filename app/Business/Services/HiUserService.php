<?php

namespace App\Business\Services;

use App\Business\Interfaces\MessageServiceInterface;

class HiUserService implements MessageServiceInterface
{
    public function hi()
    {
        return "Hello world from user service";
    }
}