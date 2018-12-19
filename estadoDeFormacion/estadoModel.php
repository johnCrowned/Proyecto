<?php
class estadoInfo{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(estado $data){
	
	try{
		$sql = "INSERT INTO formationstatus (statusId,statusF)
		VALUES(?,?)";


	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('statusId'),
	     		$data->_GET('statusF'),
	     		
	     		
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
		$stm = $this->pdo->Prepare('SELECT * FROM formationstatus ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new estado();
			$usu->_SET('statusId', $r->statusId);
			$usu->_SET('statusF', $r->statusF);
			
			
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($statusId){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM formationstatus where statusId=?");

        $stm->execute(array($statusId));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new estado();

			$usu->_SET('statusId', $r->statusId);
			$usu->_SET('statusF', $r->statusF);
			
		

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(estado $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE formationstatus SET statusF= ? WHERE statusId=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('statusF'),
 			$data->_GET('statusId')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($statusId){
	try{
		$stm= $this->pdo->prepare("DELETE FROM formationstatus WHERE statusId=?");
		$stm->execute(array($statusId));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}
?>