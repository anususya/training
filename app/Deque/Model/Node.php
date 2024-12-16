<?php
namespace Deque\Model;
class Node
{
    public null|Node $parent = null;
    public null|Node $child  = null;
    public mixed $value;

    public function __construct($value, null|Node $parent, null|Node $child)
    {
        $this->value = $value;
        $this->parent = $parent;
        $this->child = $child;
    }
}
