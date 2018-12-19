<?php
class programStatusModel{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(programStatus $data){
	
	try{
		$sql = "INSERT INTO programStatus (programStatusID,idStatus)
		VALUES(?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('programStatusID'),
	     		$data->_GET('idStatus'),
	     		
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
		$stm = $this->pdo->Prepare('SELECT * FROM programStatus ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new programStatus();
			$usu->_SET('programStatusID', $r->programStatusID);
			$usu->_SET('idStatus', $r->idStatus);
			
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($programStatusID){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM programStatus where programStatusID=?");

        $stm->execute(array($programStatusID));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new programStatus();

        $usu->_SET('programStatusID', $r->programStatusID );
		$usu->_SET('idStatus', $r->idStatus );
		

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(programStatus $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE programStatus SET idStatus= ? WHERE programStatusID=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('idStatus'),
 			$data->_GET('programStatusID')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($documentName){
	try{
		$stm= $this->pdo->prepare("DELETE FROM programStatus WHERE programStatusID=?");
		$stm->execute(array($documentName));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}
?>