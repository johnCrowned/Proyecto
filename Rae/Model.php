<?php
class RAECLASS{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}






//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(RAE $data){
	try{
		$sql = "INSERT INTO learningresult (codeL,denomination,codeC,programCode_version)
		VALUES(?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('codeL'),
	     		$data->_GET('denomination'),
	     		$data->_GET('codeC'),
	     		$data->_GET('programCode_version')
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
		$stm = $this->pdo->Prepare('SELECT * FROM learningresult ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new RAE();
			$usu->_SET('codeL', $r->codeL);
			$usu->_SET('denomination', $r->denomination);
			$usu->_SET('codeC', $r->codeC);
			$usu->_SET('programCode_version', $r->programCode_version);
			
		
		
			
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
                  ->prepare("SELECT * FROM learningresult where codeL=?");

        $stm->execute(array($codeL));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu = new RAE();
			$usu->_SET('codeL', $r->codeL);
			$usu->_SET('denomination', $r->denomination);
			$usu->_SET('codeC', $r->codeC);
			$usu->_SET('programCode_version', $r->programCode_version);
			
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(RAE $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE learningresult SET denomination= ?, codeC= ?,programCode_version=? WHERE codeL=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('denomination'),
 			$data->_GET('codeC'),
 			$data->_GET('programCode_version'),
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
		$stm= $this->pdo->prepare("DELETE FROM learningresult WHERE codeL=?");
		$stm->execute(array($codeL));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
