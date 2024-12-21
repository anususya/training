<?php
namespace Tasks\Stack;

class Temperature
{

    /**
     * @param Integer[] $temperatures
     * @return Integer[]
     */
    public function dailyTemperatures($temperatures)
    {
        $res = array_fill(0, count($temperatures), 0);
        $stack = [];
        for ($i = 0; $i < count($temperatures)-1; $i++) {
            for ($j=$i+1; $j < count($temperatures); $j++) {
                $stack[] = $temperatures[$j];
                if ($temperatures[$j] > $temperatures[$i]) {
                    $res[$i] = count($stack);
                    $stack = [];
                    break;
                }
            }
        }

        return $res;
    }
}
