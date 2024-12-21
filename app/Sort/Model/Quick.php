<?php

namespace Sort\Model;

class Quick implements SortInterface
{
    public function sort($array): array
    {
        if (!empty($array)) {
            $this->quickSortImpl($array, 0, count($array) - 1);
        }

        return $array;
    }

    private function quickSortImpl(&$arr, $start, $end): void
    {
        if ($start < $end) {
            $q = $this->partition($arr, $start, $end);
            $this->QuickSortImpl($arr, $start, $q - 1);
            $this->QuickSortImpl($arr, $q + 1, $end);
        }
    }

    private function partition(&$arr, $start, $end)
    {
        $x = $arr[$end];
        $less = $start;
        for ($i = $start; $i < $end; ++$i) {
            if ($arr[$i] <= $x) {
                $this->swap($arr[$i], $arr[$less]);
                ++$less;
            }
        }
        $this->swap($arr[$less], $arr[$end]);

        return $less;
    }

    private function swap(&$x, &$y): void
    {
        $buff = $x;
        $x = $y;
        $y = $buff;
    }
}
