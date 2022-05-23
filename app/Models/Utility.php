<?php

namespace App\Models;

class Utility
{

    public function get_random($max_random)
    {
        return strtoupper(random_string('alnum', $max_random));
    }

    public function get_bcrypt($prefix)
    {
        return password_hash($prefix, PASSWORD_BCRYPT);
    }
}
