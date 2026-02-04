<?php
$name="subhashini";
$age=19;
$height=156.5;
$bool=true;
$arr=array("subbu","harshi","chilaka");
echo "My name is $name<br> ";
echo "My age is $age<br>";
echo "My height is $height<br>";
echo "I am a very good girl -> $bool<br>";
print_r($arr);
echo "<br>";
//local scope
function hello(){
    $Xam="Be ready for exams";
    echo "$Xam"."<br>";
}
hello();

$movie="rajasaab";
function hell(){
    global $movie;
    echo $movie."<br>";
}
hell();

function co(){
    static $var=0;
    $var++;
    echo $var."<br>";
}
co();
co();

?>