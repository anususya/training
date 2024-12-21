<?php
namespace Search\Model;

class BinarySearch
{
    public static function search($numbersArray, $targetNumber): array
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
