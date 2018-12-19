<?php
class fichaClas{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}






//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(ficha $data){
	try{
		$sql = "INSERT INTO ficha (fichaNumber,statusf,programCode_version,workingDayName)
		VALUES(?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('fichaNumber'),
	     		$data->_GET('statusf'),
	     		$data->_GET('programCode_version'),
	     		$data->_GET('workingDayName')
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
		$stm = $this->pdo->Prepare('SELECT * FROM ficha ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new ficha();
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('statusf', $r->statusf);
			$usu->_SET('programCode_version', $r->programCode_version);
			$usu->_SET('workingDayName', $r->workingDayName);
			
		
		
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($fichaNumber){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM ficha where fichaNumber=?");

        $stm->execute(array($fichaNumber));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new ficha();
          $usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('statusf', $r->statusf);
			$usu->_SET('programCode_version', $r->programCode_version);
			$usu->_SET('workingDayName', $r->workingDayName);
			
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(ficha $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE ficha SET statusf= ?, programCode_version= ?,workingDayName=? WHERE fichaNumber=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('statusf'),
 			$data->_GET('programCode_version'),
 			$data->_GET('workingDayName'),
 			$data->_GET('fichaNumber')

 			)
	     	);

	 }catch(exception $e){
	 	die($e->getMessage());
	 }
}

//funciones que permite eliminar los registros

public function eliminar ($fichaNumber){
	try{
		$stm= $this->pdo->prepare("DELETE FROM ficha WHERE fichaNumber=?");
		$stm->execute(array($fichaNumber));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
