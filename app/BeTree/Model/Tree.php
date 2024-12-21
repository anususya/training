<?php
namespace BeTree\Model;

use BeTree\Model\TreeNode as TreeNode;

class Tree
{
    private ?TreeNode $root  = null;

    public function isEmpty(): bool
    {
        return $this->root === null;
    }

    public function getRoot(): ?TreeNode
    {
        return $this->root;
    }

    public function insert(int $value) : void
    {
        $node = new TreeNode($value);
        $this->insertNode($node, $this->root);
    }

    private function insertNode(TreeNode $node, &$subtree) : void
    {
        if (is_null($subtree)) {
            $subtree = $node;
        } else {
            if ($node->value < $subtree->value) {
                $this->insertNode($node, $subtree->left);
            } elseif ($node->value > $subtree->value) {
                $this->insertNode($node, $subtree->right);
            }
        }
    }

    public function preOrderPrint(?TreeNode $node) : void
    {
        if ($node !== null) {
            echo $node->value . ' ';
        }
        if ($node->left !== null) {
            $this->preOrderPrint($node->left);
        }
        if ($node->right !== null) {
            $this->preOrderPrint($node->right);
        }
    }

    public function search(int $value) : int|bool
    {
        $node = $this->searchNode($value, $this->root);

        if ($node !== null) {
            return $node->value;
        }

        return false;
    }

    private function &searchNode($value, &$subtree) : ?TreeNode
    {
        if ($subtree !== null) {
            if ($value < $subtree->value) {
                return $this->searchNode($value, $subtree->left);
            } elseif ($value > $subtree->value) {
                return $this->searchNode($value, $subtree->right);
            }
        }

        return $subtree;
    }

    public function delete($value) : void
    {
        $node = &$this->searchNode($value, $this->root);
        $this->deleteNode($node);
    }

    private function deleteNode(&$node) : void
    {
        if ($node !== null) {
            if ($node->left === null and $node->right === null) {
                $node = null;
            } elseif ($node->left === null) {
                $node = $node->right;
            } elseif ($node->right === null) {
                $node = $node->left;
            } else {
                $minNode = &$this->getMinNode($node->right);
                $node->value = $minNode->value;

                if ($minNode->right !== null) {
                    $this->deleteNode($minNode);
                } else {
                    $minNode = null;
                }
            }
        }
    }

    public function &getMinNode(&$subtree) : ?TreeNode
    {
        if ($subtree->left === null) {
            return $subtree;
        } else {
            return $this->getMinNode($subtree->left);
        }
    }
}
