<?php
class programaClas{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}






//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(programa $data){
	try{
		$sql = "INSERT INTO program (programCode_version,programName,programStatusID,idLevelTraining)
		VALUES(?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('programCode_version'),
	     		$data->_GET('programName'),
	     		$data->_GET('programStatusID'),
	     		$data->_GET('idLevelTraining')
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
		$stm = $this->pdo->Prepare('SELECT * FROM program ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new programa();
			$usu->_SET('programCode_version', $r->programCode_version);
			$usu->_SET('programName', $r->programName);
			$usu->_SET('programStatusID', $r->programStatusID);
			$usu->_SET('idLevelTraining', $r->idLevelTraining);
		
		
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($programCode_version){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM program where programCode_version=?");

        $stm->execute(array($programCode_version));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new programa();
          $usu->_SET('programCode_version', $r->programCode_version);
			$usu->_SET('programName', $r->programName);
			$usu->_SET('programStatusID', $r->programStatusID);
			$usu->_SET('idLevelTraining', $r->idLevelTraining);
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(programa $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE program SET programName=?,programStatusID=?, idLevelTraining=? WHERE programCode_version=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('programName'),
 			$data->_GET('programStatusID'),
 			$data->_GET('idLevelTraining'),
 			$data->_GET('programCode_version')

 			)
	     	);

	 }catch(exception $e){
	 	die($e->getMessage());
	 }
}

//funciones que permite eliminar los registros

public function eliminar ($programCode_version){
	try{
		$stm= $this->pdo->prepare("DELETE FROM program WHERE programCode_version=?");
		$stm->execute(array($programCode_version));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
