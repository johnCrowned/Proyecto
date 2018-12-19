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


///--------- SUBIR FOTO ----

$fecha=date("GHs");
$nombreFecha=$data->_GET('photo');
$foto=$fecha.'---'.$nombreFecha;
$dir_subida = '../img/';
$imagen=$_FILES['archivo']['name'];
$imagenFinal=$fecha.'---'.$imagen;
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



//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registroMasivo(persona $data){
	try{


///--------- SUBIR FOTO ----

$fecha=date("GHs");
if($data->_GET('photo') != ''){

$nombreFecha=$data->_GET('photo');
$foto=$fecha.'---'.$nombreFecha;
$dir_subida = '../img/';
$imagen=$_FILES['archivo']['name'];
$imagenFinal=$fecha.'---'.$imagen;
//$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);
$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);
//$fichero_subido = $dir_subida.$fecha.basename($_FILES['archivo']['name']);

//if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
 if(move_uploaded_file($_FILES['archivo']['tmp_name'],$dir_subida.'/'.$imagenFinal)){
 
    
     //$fichero_subido;

} else {
    echo "¡Posible ataque de subida de ficheros! ".$_FILES['archivo']['name'];
}

}else{
	
$foto = '';

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


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($documentNumber){
	try{

	 $stm=$this->pdo
                  //->prepare("SELECT * FROM customer,users where documentNumber=?");
			->prepare("SELECT customer.documentNumber, customer.firstName, customer.secondName,customer.firstLastName,customer.secondLastName,customer.documentName, users.mail,users.passwordUser, users.photo, customer_has_role.terminationDate from customer, users, customer_has_role where customer.documentNumber=users.documentNumber and customer.documentNumber = customer_has_role.documentNumber and customer.documentNumber=".$documentNumber);
        $stm->execute(array($documentNumber));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new persona();

        $usu->_SET('documentNumber', $r->documentNumber );
		
		$usu->_SET('secondName', $r->secondName );
		$usu->_SET('firstName', $r->firstName );
		$usu->_SET('firstLastName', $r->firstLastName );
		$usu->_SET('secondLastName', $r->secondLastName );
		$usu->_SET('documentName', $r->documentName );
		$usu->_SET('passwordUser', $r->passwordUser );
		$usu->_SET('photo', $r->photo );
		$usu->_SET('mail', $r->mail );
		$usu->_SET('terminationDate', $r->terminationDate );

		return $usu;
	
		

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(persona $data){

	//var_dump($data);
	//exit();

	try{


///--------- SUBIR FOTO ----

$fecha=date("GHs");
$nombreFecha=$data->_GET('photo');

if($data->_GET('photoaction') == 2){

$foto=$data->_GET('photo');
}else
if($data->_GET('photoaction') == 1){
	
$foto=$fecha.'---'.$nombreFecha;
}

$dir_subida = '../img/';
$imagen=$_FILES['archivo']['name'];
$imagenFinal=$fecha.'---'.$imagen;
//$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);
$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);
//$fichero_subido = $dir_subida.$fecha.basename($_FILES['archivo']['name']);

//if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
 if(move_uploaded_file($_FILES['archivo']['tmp_name'],$dir_subida.'/'.$imagenFinal)){
 

} else {
    echo "¡Posible ataque de subida de ficheros Update! ".$_FILES['archivo']['name'];
}


///--------- SUBIR FOTO ----



		 $sql="UPDATE customer SET firstName= ?, secondName= ?, firstLastName= ?, secondLastName= ?,documentName=? WHERE documentNumber=? ";
	$this->pdo->prepare($sql)->execute(
		array(
 			
 			$data->_GET('firstName'),
 			$data->_GET('secondName'),
 			$data->_GET('firstLastName'),
 			$data->_GET('secondLastName'),
 			$data->_GET('documentName'),
 			$data->_GET('documentNumber')
 			

 			)
	     	);

	//Actualiza la tabla usuario//
	
	$sql="UPDATE users SET passwordUser= ?, photo= ?, mail= ?,documentName=?  WHERE documentNumber=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			
 			$data->_GET('passwordUser'),
 			$foto,
			//$data->_GET('photo'),
 			$data->_GET('mail'),
 			$data->_GET('documentName'),
 			$data->_GET('documentNumber')

 			)
	     	);
	//Actualiza la tabla Customer-Has-Rol//
	$sql="UPDATE customer_has_role SET statusCustomerRole= ?, terminationDate= ?  WHERE roleId= ? and documentNumber=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			
 			$data->_GET('statusCustomerRole'),
 			$data->_GET('terminationDate'),
 			$data->_GET('roleId'),
 			$data->_GET('documentNumber')
			)
	     	);


	 }catch(exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($documentNumber){
	try{

		

		$stm= $this->pdo->prepare("DELETE FROM apprentice WHERE documentNumber=?");
		$stm->execute(array($documentNumber));

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
