<?php
class fichaInstructorClass{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}






//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(fichainstructor $data){
	try{
		$sql = "INSERT INTO fichainstructor (documentNumber,documentName,fichaNumber,trimesterId,workingDayName,idLevelTraining,insTypeId)
		VALUES(?,?,?,?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('documentNumber'),
	     		$data->_GET('documentName'),
	     		$data->_GET('fichaNumber'),
	     		$data->_GET('trimesterId'),
	     		$data->_GET('workingDayName'),
	     		$data->_GET('idLevelTraining'),
	     		$data->_GET('insTypeId')
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
		$stm = $this->pdo->Prepare('SELECT * FROM fichainstructor ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new fichaInstructor();
			$usu->_SET('documentNumber', $r->documentNumber);
			$usu->_SET('documentName', $r->documentName);
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('trimesterId', $r->trimesterId);
			$usu->_SET('workingDayName', $r->workingDayName);
			$usu->_SET('idLevelTraining', $r->idLevelTraining);
			$usu->_SET('insTypeId', $r->insTypeId);
		
		
			
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
                  ->prepare("SELECT * FROM fichainstructor where documentNumber=?");

        $stm->execute(array($documentNumber));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new fichaInstructor();
            $usu = new fichaInstructor();
			$usu->_SET('documentNumber', $r->documentNumber);
			$usu->_SET('documentName', $r->documentName);
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('trimesterId', $r->trimesterId);
			$usu->_SET('workingDayName', $r->workingDayName);
			$usu->_SET('idLevelTraining', $r->idLevelTraining);
			$usu->_SET('insTypeId', $r->insTypeId);
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(fichainstructor $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE fichainstructor SET fichaNumber= ?, trimesterId= ?, workingDayName= ?, idLevelTraining= ?,insTypeId= ? WHERE documentNumber=? and documentName=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('fichaNumber'),
 			$data->_GET('trimesterId'),
 			$data->_GET('workingDayName'),
 			$data->_GET('idLevelTraining'),
 			$data->_GET('insTypeId'),
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
		$stm= $this->pdo->prepare("DELETE FROM fichainstructor WHERE documentNumber=?");
		$stm->execute(array($documentNumber));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
