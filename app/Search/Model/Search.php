<?php
namespace Search\Model;
class Search
{
    public function search($item, $array, callable $searchMethod)
    {
        return $searchMethod($array, $item);
    }

    private function lineSearch($numbersArray, $targetNumber): array
    {
        $foundIndex = -1;
        $operations = 0;
        for ($i = 0; $i < count($numbersArray); $i++) {
            $operations += 1;
            if ($numbersArray[$i] === $targetNumber) {
                $foundIndex = $i;
                return [ $foundIndex, $operations]; // Элемент найден
            }
        }

        return [$foundIndex, $operations];
    }

    private function binarySearch($numbersArray, $targetNumber): array
    {
        $left = 0;
        $right = count($numbersArray) - 1;
        $foundIndex = -1;
        $operations = 0;

        while ($left <= $right) {
            $operations += 1;
            $mid = intdiv(($left + $right), 2);

            if ($numbersArray[$mid] === $targetNumber) {
                $foundIndex =  $mid; // Элемент найден
                break;
            } elseif ($numbersArray[$mid] < $targetNumber) {
                $left = $mid + 1; // Ищем в правой половине
            } else {
                $right = $mid - 1; // Ищем в левой половине
            }

        }

        return [$foundIndex, $operations]; // Элемент не найден
    }
}
