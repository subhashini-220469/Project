<?php
$file="assignment.txt";


$f=fopen($file,"w");
fwrite($f,"hello my dear\n");
fclose($f);


$f=fopen($file,"a");
fwrite($f,"can i be your valentine\n");
fclose($f);


$f=fopen($file,"r");
echo fread($f,filesize($file));
fclose($f);


fopen("assignment1.txt","x");


$f=fopen($file,"r+");
fwrite($f,"happy");
fclose($f);


$f=fopen($file,"w+");
fwrite($f,"1 2 3 eeroju nenu free\n 4  5 6 nitho nenu fix\n");
fclose($f);


$f=fopen($file,"a+");
fwrite($f,"em ala chustunnav kasta navvachu kadaa\n");
fclose($f);

?>