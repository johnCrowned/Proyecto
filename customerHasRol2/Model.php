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

public function registrar(customerHasRol $data){
	try{
		$sql = "INSERT INTO customer_has_Role (statusCustomerRole,terminationDate,documentName,documentNumber,roleId)
		VALUES(?,?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('statusCustomerRole'),
	     		$data->_GET('terminationDate'),
	     		$data->_GET('documentName'),
	     		$data->_GET('documentNumber'),
	     		$data->_GET('roleId')
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
		$stm = $this->pdo->Prepare('SELECT * FROM customer_has_Role ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new customerHasRol();
			$usu->_SET('statusCustomerRole', $r->statusCustomerRole);
			$usu->_SET('terminationDate', $r->terminationDate);
			$usu->_SET('documentName', $r->documentName);
			$usu->_SET('documentNumber', $r->documentNumber);
			$usu->_SET('roleId', $r->roleId);
		
		
			
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
                  ->prepare("SELECT * FROM customer_has_Role where documentNumber=?");

        $stm->execute(array($documentNumber));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new customerHasRol();
            $usu->_SET('statusCustomerRole', $r->statusCustomerRole);
			$usu->_SET('terminationDate', $r->terminationDate);
			$usu->_SET('documentName', $r->documentName);
			$usu->_SET('documentNumber', $r->documentNumber);
			$usu->_SET('roleId', $r->roleId);
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(customerHasRol $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE customer_has_Role SET statusCustomerRole= ?, terminationDate= ? WHERE roleId= ? and documentNumber=? and documentName=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('statusCustomerRole'),
 			$data->_GET('terminationDate'),
 			$data->_GET('roleId'),
 			$data->_GET('documentNumber'),
 			$data->_GET('documentName')

 			)
	     	);

	 }catch(exception $e){
	 	die($e->getMessage());
	 }
}

//funciones que permite eliminar los registros

public function eliminar ($documentNumber){
	try{
		$stm= $this->pdo->prepare("DELETE FROM customer_has_Role WHERE documentNumber=?");
		$stm->execute(array($documentNumber));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
