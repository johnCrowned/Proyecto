<?php
class listachequeoclas{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}






//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(listachequeo $data){
	try{
		$sql = "INSERT INTO checklist (listId,statusCL,programCode_version)
		VALUES(?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('listId'),
	     		$data->_GET('statusCL'),
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
		$stm = $this->pdo->Prepare('SELECT * FROM checklist ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new listachequeo();
			$usu->_SET('listId', $r->listId);
			$usu->_SET('statusCL', $r->statusCL);
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

public function obtener($listId){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM checklist where listId=?");

        $stm->execute(array($listId));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new listachequeo();
           $usu->_SET('listId', $r->listId);
			$usu->_SET('statusCL', $r->statusCL);
			$usu->_SET('programCode_version', $r->programCode_version);
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(listachequeo $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE checklist SET statusCL= ?, programCode_version= ? WHERE listId=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('statusCL'),
 			$data->_GET('programCode_version'),
 			$data->_GET('listId')

 			)
	     	);

	 }catch(exception $e){
	 	die($e->getMessage());
	 }
}

//funciones que permite eliminar los registros

public function eliminar ($listId){
	try{
		$stm= $this->pdo->prepare("DELETE FROM checklist WHERE listId=?");
		$stm->execute(array($listId));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
