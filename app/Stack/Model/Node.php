<?php
namespace Stack\Model;
class Node
{
    public null|Node $next;
    public mixed $value;
    public function __construct($value, null|Node $next)
    {
        $this->next = $next;
        $this->value = $value;
    }
}
