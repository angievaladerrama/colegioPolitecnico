<?php include 'includes/redirect.php';?>
<?php require_once("includes/header.php")?>
<?php
function mostrarError($error, $field){
  if(isset($error[$field]) && !empty($field)){
    $alerta='<div class="alert alert-danger">'.$error[$field].'</div>';
  }else{
    $alerta='';
  }
  return $alerta;
}
function setValueField($datos,$field, $textarea=false){
  if(isset($datos) && count($datos)>=1){
    if($textarea != false){
      echo $datos[$field];
    }else{
      echo "value='{$datos[$field]}'";
    }
  }
}
//Buscar Usuario
if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
  header("location:index.php");
  }
$id=$_GET["id"];
$user_query=mysqli_query($db, "SELECT * FROM users WHERE user_id={$id}");
$user=mysqli_fetch_assoc($user_query);
if(!isset($user["user_id"]) || empty($user["user_id"])){
  header("location:index.php");
}
//Validar usuario
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
        //colocar entre comentarios par activar la actualización
     //if(!empty($_POST["password"]) && strlen($_POST["password"]>=6)){
       //$email_validador=true;
      //}else{
      //$email_validador=false;
       //$error["password"]="Introduzca una contraseña de más de seis caracteres";
        //}
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
        //nuevo código
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
    //Actualizar Usuarios en la base de Datos
    if(count($error)==0){
      $sql= "UPDATE users set identificacion='{$_POST["identificacion"]}',"
      . "nombre='{$_POST["nombre"]}',"
      . "apellidos= '{$_POST["apellidos"]}',"
      . "email= '{$_POST["email"]}',"
      . "direccion= '{$_POST["direccion"]}',"
      . "acudiente= '{$_POST["acudiente"]}',"
      . "telefonoAcudiente= '{$_POST["telefonoAcudiente"]}',";
      if(isset($_POST["password"]) && !empty($_POST["password"])){
        $sql.= "password='".sha1($_POST["password"])."', ";
     }
     //Código nuevo
     if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){
       $sql.= "image='{$image}', ";
    }
      $sql.= "role= '{$_POST["role"]}'WHERE user_id={$user["user_id"]};";
      $update_user=mysqli_query($db, $sql);
      if($update_user){
        $user_query=mysqli_query($db, "SELECT * FROM users WHERE user_id={$id}");
        $user=mysqli_fetch_assoc($user_query);
      }
    }else{
      $update_user=false;
    }
}
?>
<h2>Editar Estudiante <?php echo $user["user_id"]."-".$user["nombre"]." ".$user["apellidos"];?></h2>
<?php if(isset($_POST["submit"]) && count($error)==0 && $update_user !=false){?>
  <div class="alert alert-success">
    El usuario se ha actualizado correctamente !!
  </div>
<?php }elseif(isset($_POST["submit"])){?>
  <div class="alert alert-danger">
    El usuario NO se ha actualizado correctamente !!
  </div>
<?php } ?>
<form action="" method="POST" enctype="multipart/form-data">
<label for="identificacion">Documento de Identidad:
    <input type="text" name="identificacion" class="form-control" <?php setValueField($user, "identificacion");?>/>
    <?php echo mostrarError($error, "identificacion");?>
    </label>
    </br></br>
    <label for="nombre">Nombre:
    <input type="text" name="nombre" class="form-control" <?php setValueField($user, "nombre");?>/>
    <?php echo mostrarError($error, "nombre");?>
    </label>
    </br></br>
    <label for="apellidos">Apellidos:
        <input type="text" name="apellidos" class="form-control" <?php setValueField($user, "apellidos");?>/>
        <?php echo mostrarError($error, "apellidos");?>
    </label>
    </br></br>
    <label for="email">Email:
        <input type="email" name="email" class="form-control" <?php setValueField($user, "email");?>/>
        <?php echo mostrarError($error, "email");?>
    </label>
    </br></br>
    <label for="image">
      <?php if($user["image"] != null){?>
        Imagen de Perfil: <img src="uploads/<?php echo $user["image"] ?>" width="100"/><br/>
      <?php } ?>
        Actualizar Imagen de Perfil:
        <input type="file" name="image" class="form-control"/>
        <!--Nuevo Código-->

    </label>
    </br></br>
    <label for="password">Contraseña:
        <input type="password" name="password" class="form-control"/>
        <?php echo mostrarError($error, "password");?>
    </label>
    </br></br>
    <label for="role" class="form-control">Rol:
        <select name="role">
        <option value="0" <?php if($user["role"]==0){echo "selected='selected'";}?>>Normal</option>
            <option value="1" <?php if($user["role"]==1){echo "selected='selected'";}?>>Administrador</option>
        </select>
        <?php echo mostrarError($error, "role");?>
    </label>
    </br></br>
    <label for="direccion">direccion:
        <textarea name="direccion" class="form-control"><?php setValueField($user, "direccion", true);?></textarea>
        <?php echo mostrarError($error, "direccion");?>
    </label>
    </br></br>
    <label for="acudiente">Acudiente:
    <input type="text" name="acudiente" class="form-control" <?php setValueField($user, "acudiente");?>/>
    <?php echo mostrarError($error, "acudiente");?>
    </label>
    </br></br>
    <label for="telefonoAcudiente">telefono de Acudiente:
    <input type="text" name="telefonoAcudiente" class="form-control" <?php setValueField($user, "telefonoAcudiente");?>/>
    <?php echo mostrarError($error, "telefonoAcudiente");?>
    </label>
    </br></br>
    <input type="submit" value="Enviar" name="submit" class="btn btn-success"/>
</form>
<?php require_once("includes/footer.php")?>
