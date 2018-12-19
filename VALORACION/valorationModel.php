<?php
class valorationModel{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(valoration $data){
	
	try{
		$sql = "INSERT INTO valoration (valueV,statusV)
		VALUES(?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('valueV'),
	     		$data->_GET('statusV'),
	     		
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
		$stm = $this->pdo->Prepare('SELECT * FROM valoration ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new valoration();
			$usu->_SET('valueV', $r->valueV);
			$usu->_SET('statusV', $r->statusV);
			
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($valueV){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM valoration where valueV=?");

        $stm->execute(array($valueV));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new valoration();

        $usu->_SET('valueV', $r->valueV );
		$usu->_SET('statusV', $r->statusV );
		

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(valoration $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE valoration SET statusV= ? WHERE valueV=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('statusV'),
 			$data->_GET('valueV')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($valueV){
	try{
		$stm= $this->pdo->prepare("DELETE FROM valoration WHERE valueV=?");
		$stm->execute(array($valueV));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}