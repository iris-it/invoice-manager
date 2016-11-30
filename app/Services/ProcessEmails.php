<?php

namespace App\Services;

use App\Jobs\SendPasswordByEmail;
use App\User;

/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 30/11/2016
 * Time: 14:06
 */
class ProcessEmails
{

    private $emails = [];

    public function initialize($emails)
    {
        $this->emails = explode(',', $emails);

        return $this;
    }

    public function processUsers()
    {
        $user_list = [];

        foreach ($this->emails as $email) {

            if (User::where('email', $email)->count() > 0) {
                $user_list[] = User::where('email', $email)->get()->first();
                continue;
            }

            $name = explode('@', $email)[0];
            $name = str_replace('.', ' ', $name);
            $name = title_case($name);

            $user = ['name' => $name, 'email' => $email];

            $user = User::create($user);
            $user_list[] = $user;
            dispatch(new SendPasswordByEmail($user));

        }

        return collect($user_list);

    }


}