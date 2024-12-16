<?php
namespace Deque\Model;
use Deque\Model\Node as Node;

class Deque
{
    private null|Node $end = null;
    private null|Node $start = null;

    public function getEnd(): ?Node
    {
        return $this->end;
    }
    public function getStart(): ?Node
    {
        return $this->start;
    }
    public function pushBack($value): void
    {
        $node = new Node($value, $this->end, null);

        if ($this->end == null && $this->start == null) {
            $this->start = $node;
        } else {
            $this->end->child = $node;
        }

        $this->end = $node;
    }
    public function pushFront($value): void
    {
        $node = new Node($value, null, $this->start);

        if ($this->start == null && $this->end == null) {
            $this->end = $node;
        } else {
            $this->start->parent = $node;
        }

        $this->start = $node;
    }

    public function printFromStart(): void
    {
        $temp = $this->start;
        while ($temp != null) {
            echo $temp->value."\n";
            $temp = $temp->child;
        }
    }

    public function printFromEnd(): void
    {
        $temp = $this->end;
        while ($temp != null) {
            echo $temp->value."\n";
            $temp = $temp->parent;
        }
    }

    public function popBack(): null|Node
    {
        if ($this->end == null) {
            return null;
        }

        if ($this->end === $this->start) {
            $this->end = null;
        }

        $temp = $this->end;
        $this->end = $temp->parent;
        $temp->parent = null;
        if ($this->end != null) {
            $this->end->child = null;
        }

        return $temp;
    }

    public function popFront(): null|Node
    {
        if ($this->start == null) {
            return null;
        }

        if ($this->end === $this->start) {
            $this->end = null;
        }

        $temp = $this->start;
        $this->start = $temp->child;
        $temp->child = null;
        if ($this->start != null) {
            $this->start->parent = null;
        }

        return $temp;
    }
}
