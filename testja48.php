<?php
	/*$cmd = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -t "balance-scale.arff"';
	exec($cmd,$output);
	for ($i=0;$i<sizeof($output);$i++)
 	{ 
 		trim($output[$i]);
 		echo $output[$i]."<br>";
 	}


?>
<?php
	$cmd = 'java -classpath "weka.jar" weka.classifiers.trees.J48  -T "balance_unseen.arff" -l "balance1.model" -p 5';
	exec($cmd,$output);
	for ($i=0;$i<sizeof($output);$i++)
 	{ 
 		trim($output[$i]);
 		echo $output[$i]."<br>";
 	}*/


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
</head>
<body>
<form method="post" action="#">
Value 1 : <input type="text" name="a"><br>
Value 2 : <input type="text" name="b"><br>
Value 3 : <input type="text" name="c"><br>
Value 4 : <input type="text" name="d"><br>
<input type="submit" value="ส่ง">
<?php
$A = $_POST["a"];
$B = $_POST["b"];
$C = $_POST["c"];
$D = $_POST["d"];

$data = array ('left-weight,left-distance,right-weight,right-distance,class',
 '5,1,3,2,L',
 '4,2,3,1,B',
 '3,5,2,1,R',
 ''.$A.','.$B.','.$C.','.$D.',?');
$fp = fopen('balance_csv.csv', 'w');
foreach($data as $line){
 $val = explode(",",$line);
 fputcsv($fp, $val);
}
fclose($fp);
// save file csv to arff-file
// -L last set last attribute is a normial value
$cmd = 'java -classpath "weka.jar" weka.core.converters.CSVLoader -N "last" balance_csv.csv > balance_unseen_test.arff ';
exec($cmd,$output);
// run unseen data -p 5 is class attribute
$cmd1 = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -T "balance_unseen_test.arff" -l "balance1.model" -p 5'; // show output prediction
exec($cmd1,$output1);
for ($i=0;$i<sizeof($output1);$i++)
{
 trim($output1[$i]);
 echo $output1[$i]."<br>";
 }

echo "<br> ข้อมูลที่ป้อนคือ ".$A.$B.$C.$D."<br>";
$returnValue = substr($output1[8], 30, 40);
echo "ผลลัพธ์ที่ได้จากการทำงานคือ ".$returnValue."<br>";

?>
</form>
</body>
</html>