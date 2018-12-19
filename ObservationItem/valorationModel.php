<?php
class ObservationClass{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(ObservationItem $data){
	
	try{
		$sql = "INSERT INTO observationitem (observationId,observation,jury,dateOI,userOI,fichaNumber,groupCode,itemId,listId)
		VALUES(?,?,?,?,?,?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('observationId'),
	     		$data->_GET('observation'),
	     		$data->_GET('jury'),
	     		$data->_GET('dateOI'),
	     		$data->_GET('userOI'),
	     		$data->_GET('fichaNumber'),
	     		$data->_GET('groupCode'),
	     		$data->_GET('itemId'),
	     		$data->_GET('listId'),


	     		
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
		$stm = $this->pdo->Prepare('SELECT * FROM observationitem ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new ObservationItem();
			$usu->_SET('observationId', $r->observationId);
			$usu->_SET('observation', $r->observation);
			$usu->_SET('jury', $r->jury);
			$usu->_SET('dateOI', $r->dateOI);
			$usu->_SET('userOI', $r->userOI);
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('groupCode', $r->groupCode);
			$usu->_SET('itemId', $r->itemId);
			$usu->_SET('listId', $r->listId);
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($observationId){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM observationitem where observationId=?");

        $stm->execute(array($observationId));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu = new ObservationItem();
			$usu->_SET('observationId', $r->observationId);
			$usu->_SET('observation', $r->observation);
			$usu->_SET('jury', $r->jury);
			$usu->_SET('dateOI', $r->dateOI);
			$usu->_SET('userOI', $r->userOI);
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('groupCode', $r->groupCode);
			$usu->_SET('itemId', $r->itemId);
			$usu->_SET('listId', $r->listId);
		

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(ObservationItem $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE observationitem SET observation= ?,jury=?,dateOI=?,userOI=?,fichaNumber=?,groupCode=?,itemId=?,listId=? WHERE observationId=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('observation'),
 			$data->_GET('jury'),
 			$data->_GET('dateOI'),
 			$data->_GET('userOI'),
 			$data->_GET('fichaNumber'),
 			$data->_GET('groupCode'),
 			$data->_GET('itemId'),
 			$data->_GET('listId'),
 			$data->_GET('observationId')


 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($observationId){
	try{
		$stm= $this->pdo->prepare("DELETE FROM observationitem WHERE observationId=?");
		$stm->execute(array($observationId));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}