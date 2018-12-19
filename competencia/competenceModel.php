<?php
class competenceModel{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(competence $data){
	
	try{
		$sql = "INSERT INTO competence (codeC,denomination,programCode_version)
		VALUES(?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('codeC'),
	     		$data->_GET('denomination'),
	     		$data->_GET('programCode_version'),
	     		
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
		$stm = $this->pdo->Prepare('SELECT * FROM competence ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new competence();
			$usu->_SET('codeC', $r->codeC);
			$usu->_SET('denomination', $r->denomination);
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

public function obtener($codeC){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM competence where codeC=?");

        $stm->execute(array($codeC));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new competence();

        $usu->_SET('codeC', $r->codeC );
		$usu->_SET('denomination', $r->denomination );
		$usu->_SET('programCode_version', $r->programCode_version );

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(competence $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE competence SET programCode_version= ? , denomination= ? WHERE codeC=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('programCode_version'),
			$data->_GET('denomination'),
 			$data->_GET('codeC')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($codeC){
	try{
		$stm= $this->pdo->prepare("DELETE FROM competence WHERE codeC=?");
		$stm->execute(array($codeC));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}