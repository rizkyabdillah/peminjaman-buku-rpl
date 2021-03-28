<?php

namespace App\Models;

class Utility
{

    public function get_random($max_random)
    {
        return strtoupper(random_string('alnum', $max_random));
    }
}
