<?php

namespace Sort;

use Fakedata\GenerateData;

class MainController
{
    private const SORT_NAMES = ['bubble','quick','merge'];
    private array $result = [];
    public function index(): void
    {
        foreach (self::SORT_NAMES as $name) {
            $generateData = new GenerateData();
            $randomArray = $generateData->generateArray(30);
            $sort = SortFactory::create($name);
            $sortResult = $sort->sort($randomArray);
            $this->result[$name]['old']= $randomArray;
            $this->result[$name]['new']= $sortResult;
        }
        include('views/index.phtml');
    }

    public function getBlock(): void
    {
        include('views/form.phtml');
    }
}
