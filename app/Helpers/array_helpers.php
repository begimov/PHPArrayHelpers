<?php

use App\Helpers\ArrayHelpers;

function array_get($arr, $prop = null, $default = null)
{
    return ArrayHelpers::get($arr, $prop, $default);
}
