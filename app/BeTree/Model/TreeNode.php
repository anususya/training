<?php
namespace BeTree\Model;
class TreeNode
{
    public ?TreeNode $left = null;
    public ?TreeNode $right = null;

    public int $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
