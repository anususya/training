<?php
namespace Stack;

use Stack\Model\Stack as StackModel;

class IndexController
{
    private array $lines = [
        'Привет Hello, world!',
        '',
        'Лёша на полке клопа нашёл'
    ];

    public function index(): void
    {
        foreach ($this->lines as $key => $line) {
            $stack = new StackModel();

            foreach (mb_str_split($line) as $value) {
                $stack->push($value);
            }

            $result = '';
            while ($stack->top != null) {
                $result .= $stack->pop()->value;
            }

            echo 'Before: ';
            echo $this->lines[$key];
            echo "<br>";
            echo 'After: ';
            echo $result;
            echo "<br>";
        }
    }
}
