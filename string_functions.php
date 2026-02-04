<?php
$str = "   Subhashini    ISKA   ";

echo "Length: " . strlen($str) . "<br>";
echo "Word Count: " . str_word_count($str) . "<br>";
echo "Reverse: " . strrev($str) . "<br>";

echo strtoupper($str) . "<br>";
echo strtolower($str) . "<br>";
echo ucfirst("Subhashini") . "<br>";
echo ucwords("Subhashini ISKA") . "<br>";

echo "Position of ISKA: " . strpos($str, "ISKA") . "<br>";
echo str_replace("Subhashini", "SUbbu", $str) . "<br>";

echo substr($str, 2, 5) . "<br>";

echo trim($str) . "<br>";
echo ltrim($str) . "<br>";
echo rtrim($str) . "<br>";

echo strcmp("subbu", "SUbbu") . "<br>";
echo strcasecmp("subbu", "Subbu") . "<br>";

$special = "<b>Hello</b>";
echo htmlspecialchars($special) . "<br>";

$password = "subbu'123";
echo addslashes($password);
?>