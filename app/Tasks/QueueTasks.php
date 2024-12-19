<?php
namespace Tasks;

class QueueTasks
{
    public function doQueueTasks()
    {
        echo "<b>Task 1: </b><br>";
        echo 'Water Height : ';
        $height = [1,9,5,2,5,4,7,9,7];
        print_r($height);
        echo '<br>';
        echo 'Result: ';
        echo $this->water($height);
        echo '<br>';

        echo "<b>Task 2: </b><br>";
        echo 'Piles : ';
        $piles = [3,6,7,11];
        print_r($piles);
        echo '<br>';
        echo 'Result : ';
        $h = 8;
        echo $this->koko($piles, $h);
        echo '<br>';

        echo "<b>Task 3: </b><br>";
        $matrix = [[1,3,5,7],[10,11,16,20],[23,30,34,60]];
        $target = 7;
        print_r($matrix);
        echo '<br>';
        echo $this->searchMatrix($matrix, $target);
    }

    private function water($height)
    {
        $res = 1;
        $length = count($height)-1;
        $left = array_shift($height);
        $right = array_pop($height);
        while ($length!=0) {
            $q = min($left, $right)*$length;
            if ($q > $res) {
                $res = $q;
            }
            $length -=1;
            if ($left < $right) {
                $left = array_shift($height);
            } else {
                $right = array_pop($height);
            }
        }

        return $res;
    }

    public function koko($piles, $h)
    {
        $r = max($piles);
        $l = min($piles);
        $count = count($piles);

        if ($count == $h) {
            return $r;
        }

        do {
            $q = 0;
            $mid = intval(($l+$r)/2) ;
            foreach ($piles as $pile) {
                $q += ceil($pile/$mid);
            }
            if ($q > $h) {
                $l = $mid+1;
            } else {
                $r = $mid;
            }
        } while ($l < $r);

        return $l;
    }

    public function searchMatrix($matrix, $target)
    {
        $rowCount = count($matrix);
        $colsCount= count($matrix[0]);
        $left = 0;
        $right = $rowCount*$colsCount-1;
        $isFound = false;

        while ($left <= $right) {
            $mid = intdiv(($left + $right), 2);
            $value = $this->getValue($mid, $colsCount, $matrix);
            if ($value === $target) {
                $isFound = true; // Элемент найден
                break;
            } elseif ($value < $target) {
                $left = $mid + 1; // Ищем в правой половине
            } else {
                $right = $mid - 1; // Ищем в левой половине
            }

        }

        return $isFound;
    }

    private function getValue($mid, $colsCount, $matrix)
    {
        if ($mid > $colsCount) {
            $x = ceil($mid/$colsCount)-1;
            $y = $mid % $colsCount;
            $y = $y ? $y-1 : 0;
        } else {
            $x = 0;
            $y = $mid ? $mid-1 : 0;
        }

        return $matrix[$x][$y];
    }
}
