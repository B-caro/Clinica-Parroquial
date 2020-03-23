<?php 
  require "php/error_handler.php";
  require "class/class.database.php";
  session_start();
  $database = new database();
  //If para revisar si sesion de usuario existe
  if(!isset($_SESSION['usuario'])){
    //Redirecciona a pagina de panel de control
    header("Location: ingresar.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Parroquia Santa Catarina</title>
  <link rel="icon" href="img/logo_vertical_black.png">

  <!-- Bootstrap CSS -->
  <link href="css_cpanel/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css_cpanel/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css_cpanel/elegant-icons-style.css" rel="stylesheet" />
  <link href="css_cpanel/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css_cpanel/style.css" rel="stylesheet">
  <link href="css_cpanel/style-responsive.css" rel="stylesheet" />
  <script>
    function validarFrmVisitas(){
      var usuario = document.getElementById("nombre_usuario").value;
      var contrasena = document.getElementById("contrasena_usuario").value;
      var error_msg = document.getElementById("error_frmUsuario");

      if(usuario === "" || contrasena === ""){
        error_msg.innerHTML = "* Por favor ingresar todos los parámetros.";
        return false;
      }
    }

    function limpiarFrmVisitas(){
      var id = document.getElementById("id_visitas");
      var fecha1 = document.getElementById("fecha_visita");
      var comentario1 = document.getElementById("comentario_visita");
	  var error_msg = document.getElementById("error_frmVisitas");
      var submitbtn = document.getElementById("subFrmVisitas");     
      var deletebtn = document.getElementById("delFrmVisitas");
      id.value = "";
      fecha1.value = "";
	  comentario1.value = "";
      submitbtn.value = "Agregar";
      deletebtn.type = "hidden";  
    }

    function seleccionarVisita(id){
	  limpiarFrmVisitas();
      var id_visita = document.getElementById("t_id_visita"+id).innerHTML;
      var fecha = document.getElementById("t_fecha"+id).innerHTML;
	  var coment = document.getElementById("t_comentario"+id).innerHTML;
      document.getElementById("id_visitas").value = id_visita;
      document.getElementById("fecha_visita").value = fecha;
      document.getElementById("comentario_visita").value = coment;
      document.getElementById("subFrmVisitas").value = "Editar";
      document.getElementById("delFrmVisitas").type = "submit";
    }
  </script>
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->

    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="cpanel.php" >
        <img src="img/logo_horizontal_white.png" class="logo" style="height: 57px">
      </a>
      <!--logo end-->
      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="img/avatar1_small.jpg">
                            </span>
                            <?php
                            $usuario = "";
                            //Linea de SQL para querry
                            $sql = "select * from usuario where id_usuario='".$_SESSION["usuario"]."'";
                            //Funcion que retorna el resultado del query
                            $result = $database->executeQuery($sql);

                            //If para revisar si existen registros
                            if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                //Ingresa el nombre de usuario en variable $usuario
                                $usuario = $row["usuario"];
                              }
                            }
                            ?>
                            <span class="username"><?= $usuario ?></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="#"><i class="icon_profile"></i> Perfil</a>
              </li>
              <li>
                <form action="" method="post" id="frmLogout">
                  <i class="icon_key_alt"></i> 
                  <input id="subLogout" name="subLogout" type="submit" value="Salir">
                </form>
                <?php
                  if(isset($_POST["subLogout"]) && $_POST["subLogout"] == "Salir"){
                    $_SESSION["usuario"] = null;
                    header("Location: ingresar.php");
                    exit();
                  }
                ?>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="">
            <a class="" href="cpanel.php">
                          <i class="icon_house_alt"></i>
                          <span>Inicio</span>
                      </a>
          </li>
          <?php 
          $sql = "select p.nombre_externo, p.nombre_interno from usuario as u inner join tipo as t on t.id_tipo = u.id_tipo inner join tipo_permiso as tp on tp.id_tipo = t.id_tipo inner join permiso as p on p.id_permiso = tp.id_permiso where u.id_usuario = '".$_SESSION["usuario"]."'";
          //Funcion que retorna el resultado del query
          $result = $database->executeQuery($sql);

          //If para revisar si existen registros
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              //Creo dinamicamente el menu
              ?>
                <li class="">
                  <a class="" href="<?= $row['nombre_interno'] ?>.php">
                                <i class="icon_house_alt"></i>
                                <span><?= $row["nombre_externo"] ?></span>
                            </a>
                </li>
              <?php
            }
          }
          ?>
          
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> Administración de Visitas</h3>
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Visita
              </header>
			  <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="frmVisitas" onsubmit="return validarFrmVisitas();" method="post" action="">
                    <input type="hidden" id="id_visitas" name="id_visitas" value="0">	
					<div class="form-group ">
                      <label for="fecha_visita" class="control-label col-lg-2">Fecha</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" id="fecha_visita" name="fecha_visita" type="date"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="comentario_visita" class="control-label col-lg-2">Comentario</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="comentario_visita" type="text" name="comentario_visita"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <input class="btn btn-primary" type="submit" name="subFrmVisitas" id="subFrmVisitas" value="Agregar">
                        <input class="btn btn-primary" type="hidden" name="delFrmVisitas" id="delFrmVisitas" value="Eliminar">
                        <input class="btn btn-default" type="button" onclick="limpiarFrmVisitas()" value="Cancelar">
                      </div>
                    </div>
                    <div class="col-lg-offset-2 col-lg-10">
                      <p style="color: red" id="error_frmVisitas"></p>
                    </div>
                  </form>
                </div>
                <?php
                if(isset($_POST["subFrmVisitas"]) && $_POST["subFrmVisitas"] == "Agregar"){	
                  $fecha = $_POST["fecha_visita"];
				  $fecha = strtotime($fecha);
				  $fecha = date('Y-m-d',$fecha);
                  $comentario = $_POST["comentario_visita"];
                  $sql = "select * from visita where fecha = '".$fecha."'";
                  //Funcion que retorna el resultado del query
                  $result = $database->executeQuery($sql);
				  
                  //If para revisar si existen registros
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<script>document.getElementById('error_frmVisitas').innerHTML = '* Una visita con esta fecha ya existe.'</script>";
                    }
                  }else{
                    $sql = "insert into visita values (0, '".$fecha."', '".$comentario."')";
                    if($database->executeNonQuery($sql)){
                      echo "<script>$('#panel').load('adm_visitas.php');</script>";
                    }
                    else{
                      echo "<script>document.getElementById('error_frmVisitas').innerHTML = '* Error al ingresar la visita.'</script>"; 
                    }
                  }
                }
                else if(isset($_POST["subFrmVisitas"]) && $_POST["subFrmVisitas"] == "Editar"){
                  $id_visita = $_POST["id_visitas"];
                  $fecha = $_POST["fecha_visita"];
                  $comentario = $_POST["comentario_visita"];

                  
                    $sql = "update visita set fecha = '".$fecha."', comentario = '".$comentario."' where id_visita ='".$id_visita."'";
                    if($database->executeNonQuery($sql)){
                      echo "<script>$('#panel').load('adm_visitas.php');</script>";
                    }
                    else{
                      echo "<script>document.getElementById('error_frmVisitas').innerHTML = '* Error al editar visita.'</script>"; 
                    }
                }
                else if(isset($_POST["delFrmVisitas"]) && $_POST["delFrmVisitas"] == "Eliminar"){
                  $id_visita = $_POST["id_visitas"];
                  $sql = "delete from visita where id_visita ='".$id_visita."'";
                  if($database->executeNonQuery($sql)){
                    echo "<script>$('#panel').load('adm_visitas.php');</script>";
                  }
                  else{
                    echo "<script>document.getElementById('error_frmVisitas').innerHTML = '* Error al eliminar visita.'</script>"; 
                  }
                }
                ?>
              </div> 
            </section>
          </div>
          <div class="col-lg-12">
            <section class="panel" id="panel">
              <header class="panel-heading">
                Visitas
              </header>
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th></i># Id</th>
                    <th><i class="icon_calendar"></i> Fecha de visita</th>
					<th></i>Comentario</th>
                    <th><i class="icon_cogs"></i> Seleccionar</th>
                  </tr>
                  <?php
                  $sql = "select * from visita";
                  //Funcion que retorna el resultado del query
                  $result = $database->executeQuery($sql);
                  //If para revisar si existen registros
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      //Creo dinamicamente las opciones del input
                      ?>
                        <tr>
                          <td id="t_id_visita<?= $row["id_visita"] ?>"><?= $row["id_visita"] ?></td>
						  <td id="t_fecha<?= $row["id_visita"] ?>"><?= $row["fecha"] ?></td>
                          <td id="t_comentario<?= $row["id_visita"] ?>"><?= $row["comentario"] ?></td>
                          <td>
                            <div class="btn-group">
                              <a class="btn btn-primary" onclick="seleccionarVisita(<?= $row["id_visita"] ?>)" href="#"><i class="icon_plus_alt2"></i></a>
                            </div>
                          </td>
                        </tr>
                      <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  <script src="js_cpanel/jquery.js"></script>
  <script src="js_cpanel/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js_cpanel/jquery.scrollTo.min.js"></script>
  <script src="js_cpanel/jquery.nicescroll.js" type="text/javascript"></script>
  <!--custome script for all page-->
  <script src="js_cpanel/scripts.js"></script>
</body>
</html>
<?php 
$database->closeConnection();
?>
