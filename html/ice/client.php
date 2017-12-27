<?php
require('Ice.php');
require('Printer.php');
 
$ic = null;
try
{
    $ic = Ice_initialize();
    $base = $ic->stringToProxy("SimplePrinter:default -p 10000");
    $printer = Demo_PrinterPrxHelper::checkedCast($base);
    if(!$printer)
    {
        throw new RuntimeException("Invalid proxy");
    }
 
    echo $printer->printString("Hello World!");
}
catch(Exception $ex)
{
    echo $ex;
}
 
if($ic)
{
    $ic->destroy(); // Clean up
}
?>
