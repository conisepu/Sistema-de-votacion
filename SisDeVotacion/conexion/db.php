<?php 

//$conn= new mysqli('sistemavotacion.mysql.database.azure.com','votaciones_db','admi@sistemavotacion','sistemavotacion123.')or die("Could not connect to mysql".mysqli_error($con));

$conn = mysqli_init();
mysqli_ssl_set($conn,NULL,NULL, "//direccion del archivo", NULL, NULL);
mysqli_real_connect($conn, 'sistemavotacion.mysql.database.azure.com', 'admi@sistemavotacion', 'sistemavotacion123.', 'votaciones_db', 3306, MYSQLI_CLIENT_SSL);

?>