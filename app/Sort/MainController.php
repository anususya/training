<?php

namespace Sort;

use Fakedata\GenerateData;

class MainController
{
    private const SORT_NAMES = ['bubble','quick','merge'];
    public function index(): void
    {

        foreach (self::SORT_NAMES as $name) {
            $generateData = new GenerateData();
            $qwerty = $generateData->generateArray(30, 1, 999);
            //print_r('Init array:');
            //print_r('<br>');
            //print_r($qwerty);
            //print_r('<br>');
            //print_r(ucwords($name));
           // print_r('<br>');
            $a = SortFactory::create($name);
            //print_r($a->sort($qwerty));
            //print_r('<br>');

            include('views/index.phtml');
        }
    }
}
