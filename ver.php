<?php include 'includes/redirect.php';?>
<?php require_once 'includes/header.php';?>
<?php
if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
  header("location:index.php");
}
$id= $_GET["id"];
$user_query = mysqli_query($db, "SELECT * FROM users WHERE user_id = {$id}");
$user=mysqli_fetch_assoc($user_query);
if(!isset($user["user_id"]) || empty($user["user_id"])){
  header("location:index.php");
}
?>
<!--Nuevo codigo-->
<?php if($user["image"] != null){?>
<div class="col-lg-5">
      <img src="uploads/<?php echo $user["image"] ?>" width="100"/>
    <?php } ?>
  </div>
<div class="col-lg-7">
<h3>Usuario: <strong><?php echo $user["nombre"]." ".$user["apellidos"];?></strong></h3>
<p>Datos</p>
<p>Numero de identificacion: <?php echo $user["identificacion"];?></p>
<p>direccion: <?php echo $user["direccion"];?></p>
<p>acudiente: <?php echo $user["acudiente"];?></p>
<p>telefono de Acudiente: <?php echo $user["telefonoAcudiente"];?></p>
<p>email: <?php echo $user["email"];?></p>
</div>
<div class="clerfix"></div>
<!--<a href="index.php" class="btn btn-success">Volver al listado</a>-->
<?php require_once 'includes/footer.php';?>
