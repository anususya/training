<?php
namespace Stack\Model;
use Stack\Model\Node as Node;
class Stack
{
    public null|Node $top = null;

    public function push($value): void
    {
        $newNode = new Node($value, $this->top);
        $this->top = $newNode;
    }

    public function pop(): null|Node
    {
        if ($this->top == null) {
            return null;
        }

        $temp = $this->top;
        $this->top = $this->top->next;
        $temp->next = null;

        return $temp;
    }

    public function printStack(): void
    {
        $temp = $this->top;
        while ($temp != null) {
            echo $temp->value."\n";
            $temp = $temp->next;
        }
    }
}
