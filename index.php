<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
  <style type="text/css" >
    .container-login {
      width: 40%;
      padding-right: 50px;
      padding-left: 50px;
      margin-right: auto;
      margin-left: auto;
      margin-top: 200px;
      background-color: black;
    }
    .fondo{
      background-image: url("imagenes/fondo-index-1.jpg");
      background-repeat: no-repeat;
      background-size: cover;

    }
    .etq{
      font-family: Century Gothic;
      color: #FFF;

    }
  </style>
</head>
<body class="fondo">
<div class="container-login jumbotron">
<form method="post" action="validar.php">  
    
    <div class="form-group">
      <label for="exampleInputEmail1" class="etq">Email</label>
      <input type="email" class="form-control" id="email" name ="email" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1" class="etq">Password</label>
      <input type="password" name= "clave" class="form-control" id="clave" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1" class="etq">Apuesta</label>
      <input type="number" class="form-control" id="apuesta" name ="apuesta" placeholder="Apuesta" required="">
    </div>
    <button type="submit" class="btn btn-primary">Ingresar</button><br>

    <label class="etq" style="text-shadow: 1px 1px #805f00;">En nuestra caja de apuestas te llevas el doble. Entra y gana ya.</label>
</form>
</div>

<?php
  if (isset($_GET['E'])) {
    if($_GET['E']==1)
    echo "<h4>Datos incorrectos</h4>";
}
  
?>

</body>
</html>