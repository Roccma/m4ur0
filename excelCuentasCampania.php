<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=Cuentas de campania.xlsx");
header("Pragma: no-cache");
header("Expires: 0");
readfile("storage/Cuentas de campania.xlsx");
?>