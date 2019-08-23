<?php
require_once 'includes/connect.php';

$sql = "CREATE TABLE IF NOT EXISTS users(
			user_id  int(255) auto_increment not null,
			identificacion	 varchar(50),
			nombre	 varchar(50),
			apellidos  varchar(255),
			email	   varchar(255),
			password   varchar(255),
			role	  varchar(20),
			direccion	text,
			acudiente varchar(255),
			telefonoAcudiente  varchar(255),
			image	   varchar(255),
			CONSTRAINT pk_users PRIMARY KEY(user_id)
		);";

$create_usuarios_table = mysqli_query($db, $sql);
$sql = "INSERT INTO users VALUES(NULL,'1002356489', 'Carlos', 'Perez', 'carlos@hotmail.com', '".sha1("password")."', '1','kra 3','Maria Jose','3124997455', NULL)";
$insert_user = mysqli_query($db, $sql);

$sql = "INSERT INTO users VALUES(NULL,'1054789652', 'Antonio', 'Perez', 'antonio@hotmail.com', '".sha1("password")."', '1','kra 4-3','Juan Jose','3174954510', NULL)";
$insert_user1 = mysqli_query($db, $sql);

$sql = "INSERT INTO users VALUES(NULL,'1854512210', 'Manuel', 'Perez', 'manuel@hotmail.com', '".sha1("password")."', '1','calle 5','Camila','3184512125', NULL)";
$insert_user2 = mysqli_query($db, $sql);

$sql = "INSERT INTO users VALUES(NULL,'1056487541', 'David', 'Perez',  'david@hotmail.com', '".sha1("password")."', '1','calle 7 -5','Marcela L','3124998455', NULL)";
$insert_user3 = mysqli_query($db, $sql);



if($create_usuarios_table){
	echo "La tabla estudiante se ha creado correctamente !!";
}
?>
