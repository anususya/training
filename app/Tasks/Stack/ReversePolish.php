<?php
namespace Tasks\Stack;

class ReversePolish
{
    public function evalRPN($tokens)
    {
        $stack = [];
        foreach ($tokens as $token) {
            if (is_numeric($token)) {
                array_push($stack, $token);
            } else {
                switch ($token) {
                    case '+':
                        $a = array_pop($stack) + array_pop($stack);
                        array_push($stack, $a);
                        break;
                    case '*':
                        $a = array_pop($stack) * array_pop($stack);
                        array_push($stack, $a);
                        break;
                    case '-':
                        $a = array_pop($stack);
                        $b = array_pop($stack);
                        array_push($stack, $b-$a);
                        break;
                    case '/':
                        $a = array_pop($stack);
                        $b = array_pop($stack);
                        array_push($stack, intval($b/$a));
                        break;
                }
            }
        }

        return array_pop($stack);
    }
}
