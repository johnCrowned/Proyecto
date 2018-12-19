<?php
class RespuestraClass{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(RespuestraGrupo $data){
	
	try{
		$sql = "INSERT INTO groupanswer (fichaNumber,dateG,groupCode,itemId,listId,valueV)
		VALUES(?,?,?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('fichaNumber'),
	     		$data->_GET('dateG'),
	     		$data->_GET('groupCode'),
	     		$data->_GET('itemId'),
	     		$data->_GET('listId'),
	     		$data->_GET('valueV'),
	     		
			)
	     );


$sql_observationitem = "INSERT INTO observationitem (observation,jury,dateOI,fichaNumber,groupCode,itemId,listId)
		VALUES(?,?,?,?,?,?,?)";

	$this->pdo->prepare($sql_observationitem)
	     ->execute(
	     	array(
	     		$data->_GET('observation'),
	     		$data->_GET('jury'),
	     		$data->_GET('dateG'),
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
		$stm = $this->pdo->Prepare('SELECT * FROM groupanswer ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new RespuestraGrupo();
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('dateG', $r->dateG);
			$usu->_SET('groupCode', $r->groupCode);
			$usu->_SET('itemId', $r->itemId);
			$usu->_SET('listId', $r->listId);
			$usu->_SET('valueV', $r->valueV);
			
			
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
                  ->prepare("SELECT * FROM groupanswer where fichaNumber=?");

        $stm->execute(array($fichaNumber));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu = new RespuestraGrupo();
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('dateG', $r->dateG);
			$usu->_SET('groupCode', $r->groupCode);
			$usu->_SET('itemId', $r->itemId);
			$usu->_SET('listId', $r->listId);
			$usu->_SET('valueV', $r->valueV);
		

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(RespuestraGrupo $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE groupanswer SET dateG= ?,groupCode=?,itemId=?,listId=?,valueV=? WHERE fichaNumber=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('dateG'),
 			$data->_GET('groupCode'),
 			$data->_GET('itemId'),
 			$data->_GET('listId'),
 			$data->_GET('valueV'),
 			$data->_GET('fichaNumber')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($fichaNumber){
	try{
		$stm= $this->pdo->prepare("DELETE FROM groupanswer WHERE fichaNumber=?");
		$stm->execute(array($fichaNumber));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}