<?php

if (! function_exists('date_br')) {
    function date_br(?string $date): string
    {
        return (is_null($date))? 'Sem prazo definido' : implode('/', array_reverse(explode('-', $date)));
    }
}
