<?php
class usuarioModel{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(persona $data){
	try{









//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////



//obtenemos el archivo .csv
$tipo = $_FILES['archivo']['type'];
 
$tamanio = $_FILES['archivo']['size'];
 
$archivotmp = $_FILES['archivo']['tmp_name'];
 
//cargamos el archivo
$lineas = file($archivotmp);
 
//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
$i=0;
 
//Recorremos el bucle para leer línea por línea
foreach ($lineas as $linea_num => $linea)
{ 
   //abrimos bucle
   /*si es diferente a 0 significa que no se encuentra en la primera línea 
   (con los títulos de las columnas) y por lo tanto puede leerla*/
   if($i != 0) 
   { 
       //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
       /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
       leyendo hasta que encuentre un ; */
       $datos = explode(";",$linea);
 
       //Almacenamos los datos que vamos leyendo en una variable
       //usamos la función utf8_encode para leer correctamente los caracteres especiales
       $nombre = utf8_encode($datos[0]);
       $edad = $datos[1];
       $profesion = utf8_encode($datos[2]);
       $profesion = utf8_encode($datos[3]);
       $profesion = utf8_encode($datos[4]);
       $profesion = utf8_encode($datos[5]);
       $profesion = utf8_encode($datos[6]);
       $profesion = utf8_encode($datos[7]);
       $profesion = utf8_encode($datos[8]);
       $profesion = utf8_encode($datos[9]);
       $profesion = utf8_encode($datos[10]);
 
       //guardamos en base de datos la línea leida
       echo "INSERT INTO datos(nombre,edad,profesion) VALUES('$nombre','$edad','$profesion') <br>";
 
       //cerramos condición
   }
 
   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
   $i++;
   //cerramos bucle
}



//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////














///--------- SUBIR FOTO ----

$fecha=date("GHs");
$nombreFecha=$data->_GET('photo');
$foto=$fecha.$nombreFecha;
$dir_subida = '../img/';
$imagen=$_FILES['archivo']['name'];
$imagenFinal=$fecha.$imagen;
//$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);
$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);
//$fichero_subido = $dir_subida.$fecha.basename($_FILES['archivo']['name']);

//if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
 if(move_uploaded_file($_FILES['archivo']['tmp_name'],$dir_subida.'/'.$imagenFinal)){
 
    
     //$fichero_subido;

} else {
    echo "¡Posible ataque de subida de ficheros! ".$_FILES['archivo']['name'];
}


///--------- SUBIR FOTO ----




		$sql = "INSERT INTO customer (documentNumber,firstName,secondName,firstLastName,secondLastName,documentName)
		VALUES(?,?,?,?,?,?)";

	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('documentNumber'),
	     		$data->_GET('firstName'),
	     		$data->_GET('secondName'),
	     		$data->_GET('firstLastName'),
	     		$data->_GET('secondLastName'),
	     		$data->_GET('documentName')
			)
	     );



	     $sql1 = "INSERT INTO users (documentName,documentNumber,passwordUser,photo,mail)
		VALUES(?,?,?,?,?)";



	$this->pdo->prepare($sql1)
	     ->execute(
	     	array(
	     		$data->_GET('documentName'),
	     		$data->_GET('documentNumber'),
	     		$data->_GET('passwordUser'),
	     		$foto,
	     		$data->_GET('mail')		
	     		)
	     );




	     $sql2 = "INSERT INTO customer_has_role (documentName,documentNumber,statusCustomerRole,roleId,terminationDate)
		VALUES(?,?,?,?,?)";



	$this->pdo->prepare($sql2)
	     ->execute(
	     	array(
	     		$data->_GET('documentName'),
	     		$data->_GET('documentNumber'),
	     		$data->_GET('statusCustomerRole'),
	     		$data->_GET('roleId'),
	     		$data->_GET('terminationDate')
			)
	     );
	} catch(Exception $e){
		die($e->getMessage());
	}
}






//funcion que permite mostrar o listar en una tabla los usuarios registrados
public function Listar(){
	try{
		$result = array();
		$stm = $this->pdo->Prepare('SELECT * FROM customer ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new persona();
			$usu->_SET('documentNumber', $r->documentNumber);
			$usu->_SET('firstName', $r->firstName);
			$usu->_SET('secondName', $r->secondName);
			$usu->_SET('firstLastName', $r->firstLastName);
			$usu->_SET('secondLastName', $r->secondLastName);
			$usu->_SET('documentName', $r->documentName);
		
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}






public function eliminar ($documentNumber){
	try{
		$stm= $this->pdo->prepare("DELETE FROM customer_has_role WHERE documentNumber=?");
		$stm->execute(array($documentNumber));

		$stm= $this->pdo->prepare("DELETE FROM users WHERE documentNumber=?");
		$stm->execute(array($documentNumber));

		$stm= $this->pdo->prepare("DELETE FROM customer WHERE documentNumber=?");
		$stm->execute(array($documentNumber));

	}
	catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
