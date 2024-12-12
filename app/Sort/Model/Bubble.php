<?php

namespace Sort\Model;

class Bubble implements SortInterface
{
    public function sort($array): array
    {
        for ($i = 0; $i+1 < count($array); ++$i) {
            for ($j = 0; $j+1 < count($array)-$i; ++$j) {
                if ($array[$j + 1] < $array[$j]) {
                    $this->swap($array[$j], $array[$j + 1]);
                }
            }
        }

        return $array;
    }

    public function swap(&$x, &$y): void
    {
        $buff = $x;
        $x = $y;
        $y = $buff;
    }
}
