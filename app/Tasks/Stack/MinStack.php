<?php
namespace Tasks\Stack;

class MinStack
{
    public array $stack = [];

    public function push($val) : void
    {
        $this->stack[] = $val;
    }

    public function pop(): ?float
    {
        if (!empty($this->stack)) {
            array_pop($this->stack);
        }

        return null;
    }

    public function top(): ?float
    {
        if (!empty($this->stack)) {
            return end($this->stack);
        }

        return null;
    }
    public function getMin(): ?float
    {
        if (!empty($this->stack)) {
            return min($this->stack);
        }

        return null;
    }
}
