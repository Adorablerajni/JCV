<?php
header('Content-Type: application/force-download');
header('Content-disposition: attachment; filename=DSR '.date('d-m-Y-H-i-s').'.xls');
// Fix for crappy IE bug in download.
header("Pragma: ");
header("Cache-Control: ");
echo $_REQUEST['datatodisplay'];
?>
