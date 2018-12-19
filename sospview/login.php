<!DOCTYPE html PUBLIC>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>
<?php  include ('head.html');?>
<style>
body{
   background:url("images/fondo_index.jpg");
}

</style>
</head>

<body>
<br><div class="col-md-6 col-md-offset-3 text-center">
 <div class="panel panel-primary">
      <div class="panel-heading"><h1>Sistema de Ingreso</h1></div>
      <div class="panel-body">
      <img src = "images/logo.png">

<form id="form1" name="form1" method="post" action="evaluar.php" class="opacity">
  
    <label>Usuario: </label>
    <input name="doc" type="text" id="doc">
    <p></p>
    <label>Password: </label>
    <input name="pass" type="Password" id="pass">
    <p></p>
   
    <input type="submit" name="Submit" value="Ingresar"><br>
</form>
</div>
</div>
</div>
</body>
</html>
