<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    /**
     * Do some additional logging – send error to BugSnag, email, Slack
    */
    public function report()
    {
        //
    }

    public function render()
    {
        return response('User not found!', 404);
    }
}
