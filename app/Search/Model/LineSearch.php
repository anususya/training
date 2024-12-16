<?php
namespace Search\Model;

class LineSearch
{
    public static function search($numbersArray, $targetNumber): array
    {
        $foundIndex = -1;
        $operations = 0;
        for ($i = 0; $i < count($numbersArray); $i++) {
            $operations += 1;
            if ($numbersArray[$i] === $targetNumber) {
                $foundIndex = $i;
                return [ $foundIndex, $operations ]; // Элемент найден
            }
        }

        return [$foundIndex, $operations ]; // Элемент не найден
    }
}
