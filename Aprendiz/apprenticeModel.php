<?php
class aprendizClass{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(aprendiz $data){
	
	try{
		$sql = "INSERT INTO apprentice (statusId,documentNumber,documentName,fichaNumber,groupCode)
		VALUES(?,?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('statusId'),
	     		$data->_GET('documentNumber'),
	     		$data->_GET('documentName'),
	     		$data->_GET('fichaNumber'),
	     		$data->_GET('groupCode')
	     		
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
		$stm = $this->pdo->Prepare('SELECT * FROM apprentice ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new aprendiz();
			$usu->_SET('statusId', $r->statusId);
			$usu->_SET('documentNumber', $r->documentNumber);
			$usu->_SET('documentName', $r->documentName);
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('groupCode', $r->groupCode);
			
			
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
                  ->prepare("SELECT * FROM apprentice where documentNumber=?");

        $stm->execute(array($documentNumber));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu = new aprendiz();
			$usu->_SET('statusId', $r->statusId);
			$usu->_SET('documentNumber', $r->documentNumber);
			$usu->_SET('documentName', $r->documentName);
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('groupCode', $r->groupCode);
		

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(aprendiz $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE apprentice SET statusId= ?,documentName=?,fichaNumber=?,groupCode=? WHERE documentNumber=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('statusId'),
 			$data->_GET('documentName'),
 			$data->_GET('fichaNumber'),
 			$data->_GET('groupCode'),
 			$data->_GET('documentNumber')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($documentNumber){
	try{
		$stm= $this->pdo->prepare("DELETE FROM apprentice WHERE documentNumber=?");
		$stm->execute(array($documentNumber));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}