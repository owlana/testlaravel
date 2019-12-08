<?php

if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        return Request::is($path) ? ' active' : '';
    }
}
