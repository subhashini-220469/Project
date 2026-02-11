<?php

$file = "sample.txt";
$f = fopen($file,"w");
fwrite($f,"Andhagatte evvarante vayyari pilla...💫<br>
Ni okka pere kanipistadi google la..❤️<br>
Nuvv agi ollu viruchukunte veyyari pilaa...😜<br>
Naku bokkalu iriginattu undi anni pakkala ...😅<br>");
fclose($f);
$f = fopen($file,"r");
echo fread($f,filesize($file));
fclose($f);
echo "<br><br>";
echo "Exists: ".file_exists($file)."<br>";
echo "Size: ".filesize($file)."<br>";
echo "Type: ".filetype($file)."<br>";
echo "Modified: ".date("d-m-Y",filemtime($file))."<br>";
echo "Modified: ".date("Y-m-d",fileatime($file))."<br>";
echo "Modified: ".date("d-m-Y",filectime($file))."<br>";
$lines = file("sample.txt");
print_r($lines);
echo  "fileperms: ".fileperms($file);
echo "<br>";
echo  "fileowner: ".fileowner($file);
echo "<br>";
echo  "fileinode: ".fileinode($file);
echo "<br>";
echo "filegroup: ".filegroup($file);
echo "<br>";
copy($file,"assignment2.txt");
rename("assignment2.txt","comb12.txt");
echo "current directory:".getcwd();
mkdir("testfolder");
echo "<br>Files in directory:<br>";
print_r(scandir("."));
unlink("comb12.txt");
rmdir("testfolder");
