<?php
namespace Deque;

use Deque\Model\Deque as DequeModel;
use Fakedata\GenerateData as GenerateData;

class IndexController
{
    public array $blockVariables = array();

    public function index(): void
    {
        $generator = new GenerateData();
        $array = $generator->generateArray(10);

        $deque = new DequeModel();
        foreach ($array as $key => $item) {
            if ($key % 2 == 1) {
                $deque->pushBack($item);
            } else {
                $deque->pushFront($item);
            }
        }

        $this->blockVariables['init'] = $array;
        $this->blockVariables['deque'] = $deque;

        include('views/main.phtml');
    }

    public function getBlock(): void
    {
        include('views/deque.phtml');
    }
}
