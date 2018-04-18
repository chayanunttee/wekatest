<?php
// outputs the username that owns the running php/httpd process

$cmd = 'ipconfig';    
exec($cmd,$output);
for ($i=0;$i<sizeof($output);$i++)    
{
   //trim($output[$i]);
   echo $output[$i]."<br>";
}   

?>

