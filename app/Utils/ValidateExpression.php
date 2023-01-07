<?php

namespace App\Utils;

class ValidateExpression
{
    public static function validate(string $expression): bool
    {
        $closeTags = [')', '}', ']'];
        $openTags = ['(', '{', '['];
        $pairs = [
            ')' => '(',
            '}' => '{',
            ']' => '['
        ];
        $array = [];
        $x = 0;
        $arrayExpression = str_split($expression);
        while ($x < count($arrayExpression)) {
            $tag = $arrayExpression[$x];
            if (in_array($tag, $openTags)) {
                $array[] = $tag;
            }

            if (in_array($tag, $closeTags)) {
                $key = array_search($pairs[$tag], $array);
                if ($key !== false) {
                    unset($array[$key]);
                } else {
                    $array[] = $tag;
                }
            }

            $x++;
        }

        return count($array) === 0;
    }
}
