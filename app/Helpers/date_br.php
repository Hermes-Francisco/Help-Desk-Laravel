<?php

if (! function_exists('date_br')) {
    function date_br(string $date): string
    {
        return implode('/', array_reverse(explode('-', $date)));
    }
}
