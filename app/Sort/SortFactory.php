<?php

namespace Sort;

use Sort\Model\SortInterface;

class SortFactory
{
    public static function create($sortName) : SortInterface
    {
        $sortName = ucwords($sortName);
        $a = __NAMESPACE__ .'\\'. 'Model' . '\\'. $sortName;
        return new $a();
    }
}
