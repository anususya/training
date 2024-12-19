<?php

namespace Tasks;

class ArrayTasks
{
    public array $task1 = ["eat","tea","tan","ate","nat","bat"];
    public array $task2 = [1,1,1,2,2,3];

    public array $task3 = [1,2,3,4];

    public array $task4 = [["5","3",".",".","7",".",".",".","."]
        ,["6",".",".","1","9","5",".",".","."]
        ,[".","9","8",".",".",".",".","6","."]
        ,["8",".",".",".","6",".",".",".","3"]
        ,["4",".",".","8",".","3",".",".","1"]
        ,["7",".",".",".","2",".",".",".","6"]
        ,[".","6",".",".",".","7","2","8","."]
        ,[".",".",".","4","1","9",".",".","5"]
        ,[".",".",".",".","8",".",".","7","9"]];

    public array $task5 = [100,4,200,1,3,2];

    public function doArrayTasks($ind): void
    {
        echo "<b> Task $ind : </b>";
        echo '<br>';
        switch ($ind) {
            case 1:
                print_r($this->groupAnagrams($this->task1));
                break;
            case 2:
                print_r($this->topKFrequent($this->task2, 2));
                break;
            case 3:
                print_r($this->productExceptSelf($this->task3));
                break;
            case 4:
                print_r($this->isValidSudoku($this->task4));
                break;
            case 5:
                print_r($this->longestConsecutive($this->task5));
                break;
        }

        echo '<br>';
    }

    public function groupAnagrams($strs): array
    {
        $result = [];
        foreach ($strs as $str) {
            $a = str_split($str);
            asort($a);
            $a = implode('', $a);
            if (array_key_exists($a, $result)) {
                $result[$a] = array_merge($result[$a], [$str]);
            } else {
                $result[$a] = [$str];
            }
        }

        $arr = [];
        foreach ($result as $str) {
            $arr[] = $str;
        }

        return $arr;
    }

    public function topKFrequent($nums, $k): array
    {
        $arr = [];
        foreach ($nums as $num) {
            if (array_key_exists($num, $arr)) {
                $arr[$num] ++;
            } else {
                $arr[$num] = 1;
            }
        }
        arsort($arr);
        $result = array_keys($arr);
        return array_slice($result, 0, $k);
    }

    public function productExceptSelf($nums)
    {
        $func = function (&$item, $key, $arr) {
            $prod = 1;
            foreach ($arr as $k => $v) {
                if ($key != $k) {
                    $prod *= $v;
                }
            }
            $item = $prod;
        };

        array_walk($nums, $func, $nums);

        return $nums;
    }

    public function isValidSudoku($board): bool
    {
        /*
        for ($i = 0; $i < 9; $i++) {
            $arrRows = [];
            $arrCols = [];

            for ($j = 0; $j < 9; $j++) {
                if (!is_numeric($board[$i][$j])) {
                    continue;
                } else {
                    if (in_array($board[$i][$j], $arrRows)) {
                        return false;
                    } else {
                        $arrRows[] = $board[$i][$j];
                    }
                }

                if (!is_numeric($board[$j][$i])) {
                    continue;
                } else {
                    if (in_array($board[$j][$i], $arrCols)) {
                        return false;
                    } else {
                        $arrCols[] = $board[$j][$i];
                    }
                }
            }
        }
*/
        for ($i = 0; $i < 9; $i++) {
            $arr = [];
            for ($j = 0; $j < 9; $j++) {
                if (!is_numeric($board[$i][$j])) {
                    continue;
                }

                if (in_array($board[$i][$j], $arr)) {
                    return false;
                } else {
                    $arr[] = $board[$i][$j];
                }
            }
        }

        for ($j = 0; $j < 9; $j++) {
            $arr = [];
            for ($i = 0; $i < 9; $i++) {
                if (!is_numeric($board[$i][$j])) {
                    continue;
                }
                if (in_array($board[$i][$j], $arr)) {
                    return false;
                } else {
                    $arr[] = $board[$i][$j];
                }
            }
        }

        $n = 0;
        $m = 0;
        for ($q = 0; $q < 9; $q++) {
            $arr = [];
            for ($i = $n; $i < $n+3; $i++) {
                for ($j = $m; $j < $m+3; $j++) {
                    if (!is_numeric($board[$i][$j])) {
                        continue;
                    }
                    if (in_array($board[$i][$j], $arr)) {
                        return false;
                    } else {
                        $arr[] = $board[$i][$j];
                    }
                }
            }
            $n = $n + 3;

            if (($q+1)%3 == 0) {
                $n = 0;
                $m = $m+3;
            }
        }
        return true;
    }

    public function longestConsecutive($nums)
    {
        sort($nums);
        $q = 0;
        $res = 1;
        for ($i=0; $i<count($nums)-1; $i++) {
            if ($nums[$i+1]-$nums[$i] == 1) {
                $res +=1;
            } else {
                if ($res > $q) {
                    $q = $res;
                }
                $res = 1;
            }
        }

        return $q;
    }
}
