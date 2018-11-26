<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 26/11/18
 * Time: 10:28
 */

namespace App\Service;


class Slugify
{
    public function generate(string $input) : string
    {
        return str_replace(' ', '-', $input);
    }
}
