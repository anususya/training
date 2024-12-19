<?php
namespace Tasks;

use Tasks\ArrayTasks as ArrayTasks;
use Tasks\Stack\MinStack as MinStack;
use Tasks\Stack\Temperature as TemperatureStack;
use Tasks\Stack\ReversePolish as ReversePolishStack;
use Tasks\QueueTasks as QueueTasks;

class IndexController
{
    public function index(): void
    {
        echo "<h1>Array Tasks:</h1> <br>";
        $a = new ArrayTasks();
        for ($i = 1; $i <= 5; $i++) {
            $a->doArrayTasks($i);
        }

        echo "<h1>Stack Tasks:</h1> <br>";
        $this->doStackTasks();

        $b = new QueueTasks();

        echo "<h1>Queue Tasks:</h1> <br>";
        $b->doQueueTasks();
    }
    private function doStackTasks(): void
    {
        echo "<b>Task 1: </b><br>";
        $minStack = new MinStack();
        $minStack->push(-2);
        $minStack->push(0);
        $minStack->push(-3);
        echo 'MinStack: ' . $minStack->getMin(); // return -3
        echo '<br>';
        $minStack->pop();
        echo 'Top: ' . $minStack->top();    // return 0
        echo '<br>';
        echo 'MinStack: ' . $minStack->getMin(); // return -2
        echo '<br>';

        echo "<b>Task 2: </b><br>";
        $reverseStack = new ReversePolishStack();
        $revPol = ["10","6","9","3","+","-11","*","/","*","17","+","5","+"];
        echo "reverse polish:";
        print_r($revPol);
        echo '<br>';
        echo 'Result: '.$reverseStack->evalRPN($revPol);
        echo '<br>';

        echo "<b>Task 3: </b><br>";
        $temp = new TemperatureStack();
        $arrayTemp = [73,74,75,71,69,72,76,73];
        echo 'Init array: ';
        print_r($arrayTemp);
        echo '<br>';
        $result = $temp->dailyTemperatures($arrayTemp);
        echo "daily temperatures:";
        print_r($result);
        echo '<br>';
    }
}
