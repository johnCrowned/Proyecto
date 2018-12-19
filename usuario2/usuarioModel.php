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
		$sql = "INSERT INTO users(mail,passwordUser,photo,documentNumber,documentName)
		VALUES(?,?,?,?,?)";


	$this->pdo->prepare($sql)
	
	     ->execute(
	     	array(
	     		$data->_GET('mail'),
	     		$data->_GET('passwordUser'),
	     		$data->_GET('photo'),
	     		$data->_GET('documentNumber'),
	     		$data->_GET('documentName')
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
		$stm = $this->pdo->Prepare('SELECT * FROM users where documentNumber="1022997832" ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new persona();
			$usu->_SET('mail', $r->mail);
			$usu->_SET('passwordUser', $r->passwordUser);
			$usu->_SET('photo', $r->photo);
			$usu->_SET('documentName', $r->documentName);
			$usu->_SET('documentNumber', $r->documentNumber);
		
		
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}

//FUNCION PARA TRAER LS REGISTROS DE CUSTOMER A USERS
public function customer(){
	try{
		$result = array();
		$stm = $this->pdo->Prepare('SELECT * FROM customer ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new customer();
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
                  ->prepare("SELECT * FROM users where documentNumber=?");

        $stm->execute(array($documentNumber));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new persona();
			$usu->_SET('mail', $r->mail);
			$usu->_SET('passwordUser', $r->passwordUser);
			$usu->_SET('photo', $r->photo);
			$usu->_SET('documentName', $r->documentName);
			$usu->_SET('documentNumber', $r->documentNumber);
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}
//FUNCION PARA TRAER LOS REGISTROS Y ACTUALIZARLOS

public function editar($documentNumber){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT documentNumber, documentName FROM customer where documentNumber=? and select passwordUser, photo, mail from users where documentNumber=? ");

        $stm->execute(array($documentNumber));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new persona();
			$usu->_SET('documentNumber', $r->documentNumber);
			$usu->_SET('documentName', $r->documentName);
		    $usu->_SET('passwordUser', $r->passwordUser);
			$usu->_SET('photo', $r->photo);
			$usu->_SET('mail', $r->mail);

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(persona $data){



	try{
		 $sql="UPDATE users SET mail= ?, passwordUser= ?, photo=? WHERE documentName=? and documentNumber=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('mail'),
	     		$data->_GET('passwordUser'),
	     		$data->_GET('photo'),
	     		$data->_GET('documentName'),
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
		$stm= $this->pdo->prepare("DELETE FROM users WHERE documentNumber=?");
		$stm->execute(array($documentNumber));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
