<?php

require "vendor/autoload.php";

/**
 * A really useful dockblock
 * @param int $arg1
 * @param int $arg2
 * @param int $arg3
 * @param FluxCapacitor $etc
 *
 * @return mixed
 */
function whats_going_on_here($arg1, $arg2, $arg3, $etc)
{
    $arg2 = transform_this($arg1);

    // What?!

    \Psy\Shell::debug(get_defined_vars());

    return $arg3 * $etc . $arg2;
}

function transform_this($arg)
{
    return $arg + 5;
}

whats_going_on_here(1, 2, 3, 4);
