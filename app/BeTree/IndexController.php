<?php

namespace BeTree;

use BeTree\Model\Tree;
use Fakedata\GenerateData as Fakedata;

class IndexController
{

    public function index() : void
    {
        $tree = new Tree();
        //$fakedata = new Fakedata();
        //$elements = $fakedata->generateArray(10, 1, 50);
        $elements = [7 , 3 , 20 , 25 , 23 , 42 , 30 , 14 , 28 , 18, 17, 19];
        print_r($elements);
        echo '<br>';
        foreach ($elements as $element) {
            $tree->insert($element);
        }
        $root = $tree->getRoot();
        $tree->preOrderPrint($root); // прямой обход дерева (NLR)

        echo '<br>';
        echo $tree->search(14);
        echo '<br>';
        $tree->delete(7);
        $root = $tree->getRoot();
        $tree->preOrderPrint($root);
    }
}
