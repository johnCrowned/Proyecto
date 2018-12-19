<?php
class documentTypeModel{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(documentType $data){
	
	try{
		$sql = "INSERT INTO documentType (documentName,description,statusDocType)
		VALUES(?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('documentName'),
	     		$data->_GET('description'),
	     		$data->_GET('statusDocType'),
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
		$stm = $this->pdo->Prepare('SELECT * FROM documentType ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new documentType();
			$usu->_SET('documentName', $r->documentName);
			$usu->_SET('description', $r->description);
			$usu->_SET('statusDocType', $r->statusDocType);
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($documentName){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM documentType where documentName=?");

        $stm->execute(array($documentName));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new documentType();

        $usu->_SET('documentName', $r->documentName );
		$usu->_SET('description', $r->description );
		$usu->_SET('statusDocType', $r->statusDocType );

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(documentType $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE documentType SET description= ?, statusDocType= ? WHERE documentName=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('description'),
 			$data->_GET('statusDocType'),
 			$data->_GET('documentName')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($documentName){
	try{
		$stm= $this->pdo->prepare("DELETE FROM documentType WHERE documentName=?");
		$stm->execute(array($documentName));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}
?>