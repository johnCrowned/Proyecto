<?php
class rae_has_trimestreClass{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}






//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(rae_has_trimestre $data){
	try{
		$sql = "INSERT INTO learningResultHasTrimester (codeL,codeC,programCode_version,trimesterId,workingDayName,idLevelTraining)
		VALUES(?,?,?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('codeL'),
	     		$data->_GET('codeC'),
	     		$data->_GET('programCode_version'),
	     		$data->_GET('trimesterId'),
	     		$data->_GET('workingDayName'),
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
		$stm = $this->pdo->Prepare('SELECT * FROM learningResultHasTrimester ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new rae_has_trimestre();
			$usu->_SET('codeL', $r->codeL);
			$usu->_SET('codeC', $r->codeC);
			$usu->_SET('programCode_version', $r->programCode_version);
			$usu->_SET('trimesterId', $r->trimesterId);
			$usu->_SET('workingDayName', $r->workingDayName);
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

public function obtener($codeL){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM learningResultHasTrimester where codeL=?");

        $stm->execute(array($codeL));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

            $usu = new rae_has_trimestre();
			$usu->_SET('codeL', $r->codeL);
			$usu->_SET('codeC', $r->codeC);
			$usu->_SET('programCode_version', $r->programCode_version);
			$usu->_SET('trimesterId', $r->trimesterId);
			$usu->_SET('workingDayName', $r->workingDayName);
			$usu->_SET('idLevelTraining', $r->idLevelTraining);
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(rae_has_trimestre $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE learningResultHasTrimester SET codeC= ?, programCode_version= ?, trimesterId= ?, workingDayName= ?, idLevelTraining= ? WHERE codeL=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('codeC'),
 			$data->_GET('programCode_version'),
 			$data->_GET('trimesterId'),
 			$data->_GET('workingDayName'),
 			$data->_GET('idLevelTraining'),
 			$data->_GET('codeL')

 			)
	     	);

	 }catch(exception $e){
	 	die($e->getMessage());
	 }
}

//funciones que permite eliminar los registros

public function eliminar ($codeL){
	try{
		$stm= $this->pdo->prepare("DELETE FROM learningResultHasTrimester WHERE codeL=?");
		$stm->execute(array($codeL));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
