<?php include 'includes/redirect.php';?>
<?php require_once 'includes/header.php';?>
<?php
function mostrarError($error, $field){
  if(isset($error[$field]) && !empty($field)){
    $alerta='<div class="alert alert-danger">'.$error[$field].'</div>';
  }else{
    $alerta='';
  }
  return $alerta;
}
function setValueField($error,$field, $textarea=false){
  if(isset($error) && count($error)>=1 && isset($_POST[$field])){
    if($textarea != false){
      echo $_POST[$field];
    }else{
      echo "value='{$_POST[$field]}'";
    }
  }
}
$error=array();
if(isset($_POST["submit"])){
 if(!empty($_POST["nombre"]) && strlen($_POST["nombre"]<=20) && !is_numeric($_POST["nombre"]) && !preg_match("/[0-9]/", $_POST["nombre"])){
$nombre_validador=true;
}else{
$nombre_validador=false;
$error["nombre"]="El nombre no es válido";
}
if(!empty($_POST["identificacion"])){
  $identificacion_validador=true;
 }else{
 $identificacion_validador=false;
  $error["identificacion"]="El numero de docuemto no puede estar vacía";
   }
  if(!empty($_POST["apellidos"])&& !is_numeric($_POST["apellidos"]) && !preg_match("/[0-9]/", $_POST["apellidos"])){
      $apellidos_validador=true;
     }else{
     $apellidos_validador=false;
       $error["apellidos"]="Los apellidos no son válidos";
        }
       
     if(!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
       $email_validador=true;
      }else{
       $email_validador=false;
       $error["email"]="Introduzca un mail válido";
        }
     if(!empty($_POST["password"]) && strlen($_POST["password"]>=6)){
       $password_validador=true;
      }else{
      $password_validador=false;
       $error["password"]="Introduzca una contraseña de más de seis caracteres";
        }
     if(isset($_POST["role"]) && is_numeric($_POST["role"])){
       $role_validador=true;
      }else{
      $role_validador=false;
       $error["role"]="Seleccione un ROL de usuario";
        }
        if(!empty($_POST["direccion"])){
          $direccion_validador=true;
         }else{
         $direccion_validador=false;
          $error["direccion"]="La direccion no puede estar vacía";
           }
        if(isset($_POST["acudiente"])){
          $acudiente_validador=true;
         }else{
         $acudiente_validador=false;
          $error["acudiente"]="Introduzca el nombre del acudiente del estudiante";
           }
           if(isset($_POST["telefonoAcudiente"])){
            $telefonoAcudiente_validador=true;
           }else{
           $telefonoAcudiente_validador=false;
            $error["telefonoAcudiente"]="Introduzca el telefono del acudiente ";
             }
      //Crear una carpeta nuevo código
      $image=null;
      if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){
        if(!is_dir("uploads")){
          $dir = mkdir("uploads", 0777, true);
        }else{
          $dir=true;
        }
        if($dir){
          $filename= time()."-".$_FILES["image"]["name"]; //concatenar función tiempo con el nombre de imagen
          $muf=move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/".$filename); //mover el fichero utilizando esta función
          $image=$filename;
          if($muf){
            $image_upload=true;
          }else{
            $image_upload=false;
            $error["image"]= "La imagen no se ha subido";
          }
        }
        //var_dump($_FILES["image"]);
        //die();
	 	}
    //Insertar Usuarios en la base de Datos
    if(count($error)==0){
      $sql= "INSERT INTO users VALUES(NULL,'{$_POST["identificacion"]}', '{$_POST["nombre"]}', '{$_POST["apellidos"]}', '{$_POST["email"]}', '".sha1($_POST["password"])."', '{$_POST["role"]}','{$_POST["direccion"]}','{$_POST["acudiente"]}','{$_POST["telefonoAcudiente"]}', '{$image}');"; //colocar image
      $insert_user=mysqli_query($db, $sql);
    }else{
      $insert_user=false;
    }
}
?>
<h1>Crear Estudiante</h1>
<?php if(isset($_POST["submit"]) && count($error)==0 && $insert_user !=false){?>
  <div class="alert alert-success">
    El usuario se ha creado correctamente !!
  </div>
<?php } ?>
<form action="crear.php" method="POST" enctype="multipart/form-data">
    <label for="identificacion">Documento de Identidad:
    <input type="text" name="identificacion" class="form-control" <?php setValueField($error, "identificacion");?>/>
    <?php echo mostrarError($error, "identificacion");?>
    </label>
    </br></br>
    <label for="nombre">Nombre:
    <input type="text" name="nombre" class="form-control" <?php setValueField($error, "nombre");?>/>
    <?php echo mostrarError($error, "nombre");?>
    </label>
    </br></br>
    <label for="apellidos">Apellidos:
        <input type="text" name="apellidos" class="form-control" <?php setValueField($error, "apellidos");?>/>
        <?php echo mostrarError($error, "apellidos");?>
    </label>
    </br></br>
   
    <label for="email">Email:
        <input type="email" name="email" class="form-control" <?php setValueField($error, "email");?>/>
        <?php echo mostrarError($error, "email");?>
    </label>
    </br></br>
    <label for="image">Imagen:
        <input type="file" name="image" class="form-control"/>
    </label>
    </br></br>
    <label for="password">Contraseña:
        <input type="password" name="password" class="form-control"/>
        <?php echo mostrarError($error, "password");?>
    </label>
    </br></br>
    <label for="role" class="form-control">Rol:
        <select name="role">
        <option value="0">Normal</option>
            <option value="1">Administrador</option>
        </select>
        <?php echo mostrarError($error, "role");?>
    </label>
    </br></br>
    <label for="direccion">direccion:
        <textarea name="direccion" class="form-control"><?php setValueField($error, "direccion", true);?></textarea>
        <?php echo mostrarError($error, "direccion");?>
    </label>
    </br></br>
    <label for="acudiente">Acudiente:
    <input type="text" name="acudiente" class="form-control" <?php setValueField($error, "acudiente");?>/>
    <?php echo mostrarError($error, "acudiente");?>
    </label>
    </br></br>
    <label for="telefonoAcudiente">telefono de Acudiente:
    <input type="text" name="telefonoAcudiente" class="form-control" <?php setValueField($error, "telefonoAcudiente");?>/>
    <?php echo mostrarError($error, "telefonoAcudiente");?>
    </label>
    </br></br>
    <input type="submit" value="Enviar" name="submit" class="btn btn-success"/>
</form>
<?php require_once 'includes/footer.php'; ?>
