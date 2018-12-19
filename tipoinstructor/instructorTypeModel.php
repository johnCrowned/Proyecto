<?php
class instructorTypeModel{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(instructorType $data){
	
	try{
		$sql = "INSERT INTO instructorType (insTypeId,statusI)
		VALUES(?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('insTypeId'),
	     		$data->_GET('statusI'),
	     		
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
		$stm = $this->pdo->Prepare('SELECT * FROM instructorType ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new instructorType();
			$usu->_SET('insTypeId', $r->insTypeId);
			$usu->_SET('statusI', $r->statusI);
			
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($insTypeId){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM instructorType where insTypeId=?");

        $stm->execute(array($insTypeId));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new instructorType();

        $usu->_SET('insTypeId', $r->insTypeId );
		$usu->_SET('statusI', $r->statusI );
		

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(instructorType $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE instructorType SET statusI= ? WHERE insTypeId=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('statusI'),
 			$data->_GET('insTypeId')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($documentName){
	try{
		$stm= $this->pdo->prepare("DELETE FROM instructorType WHERE insTypeId=?");
		$stm->execute(array($documentName));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}