<?php

namespace Sort\Model;

class Merge implements SortInterface
{
    public function sort($array): array
    {
        if (count($array) <= 1) {
            return $array;
        }

        $mid = intdiv(count($array), 2);
        $left = array_slice($array, 0, $mid);
        $right = array_slice($array, $mid);
        $left = $this->sort($left);
        $right = $this->sort($right);

        return $this->merge($left, $right);
    }
    private function merge($left, $right) : array
    {
        $sorted_list = [];
        $i = 0;
        $j = 0;

        while ($i < count($left) and $j < count($right)) {
            if ($left[$i] < $right[$j]) {
                $sorted_list[] = $left[$i];
                $i++;
            } else {
                $sorted_list[] = $right[$j];
                $j++;
            }
        }

        return array_merge($sorted_list, array_slice($left, $i), array_slice($right, $j));
    }
}
