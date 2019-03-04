<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=Contactos de campania.xlsx");
header("Pragma: no-cache");
header("Expires: 0");
readfile("storage/Contactos de campania.xlsx");
?>