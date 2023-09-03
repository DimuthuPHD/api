<?php

if (!function_exists('active_nav')) {
    function active_nav($route)
    {
        return Route::is($route) ? 'active' : '';
    }
}
