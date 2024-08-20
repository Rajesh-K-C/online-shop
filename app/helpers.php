<?php
function truncateText($text, $maxLength = 25)
{
    return (strlen($text) > $maxLength) ? substr($text, 0, $maxLength) . '...' : $text;
}
function formatFloat($number): float|int
{
    return $number == (int)$number ? (int)$number : round($number, 2);
}
