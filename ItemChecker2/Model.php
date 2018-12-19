<?php
class ItemsCheck{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}






//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(ListaCheck $data){
	try{
		$sql = "INSERT INTO listitem (itemId,itemQuestion,codeL,codeC,programCode_version,listId)
		VALUES(?,?,?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('itemId'),
	     		$data->_GET('itemQuestion'),
	     		$data->_GET('codeL'),
	     		$data->_GET('codeC'),
	     		$data->_GET('programCode_version'),
	     		$data->_GET('listId')
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
		$stm = $this->pdo->Prepare('SELECT * FROM listitem ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new ListaCheck();
			$usu->_SET('itemId', $r->itemId);
			$usu->_SET('itemQuestion', $r->itemQuestion);
			$usu->_SET('codeL', $r->codeL);
			$usu->_SET('codeC', $r->codeC);
			$usu->_SET('programCode_version', $r->programCode_version);
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

public function obtener($itemId){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM listitem where itemId=?");

        $stm->execute(array($itemId));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu = new ListaCheck();
			$usu->_SET('itemId', $r->itemId);
			$usu->_SET('itemQuestion', $r->itemQuestion);
			$usu->_SET('codeL', $r->codeL);
			$usu->_SET('codeC', $r->codeC);
			$usu->_SET('programCode_version', $r->programCode_version);
			$usu->_SET('listId', $r->listId);
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(ListaCheck $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE listitem SET itemQuestion= ?, codeL= ?, codeC= ?, programCode_version= ?,listId= ? WHERE itemId=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('itemQuestion'),
 			$data->_GET('codeL'),
 			$data->_GET('codeC'),
 			$data->_GET('programCode_version'),
 			$data->_GET('listId'),
 			$data->_GET('itemId')

 			)
	     	);

	 }catch(exception $e){
	 	die($e->getMessage());
	 }
}

//funciones que permite eliminar los registros

public function eliminar ($itemId){
	try{
		$stm= $this->pdo->prepare("DELETE FROM listitem WHERE itemId=?");
		$stm->execute(array($itemId));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
