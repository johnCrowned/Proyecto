<?php
class trimestreclas{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}






//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(trimestre $data){
	try{
		$sql = "INSERT INTO trimester (trimesterId,workingDayName,idLevelTraining)
		VALUES(?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('trimesterId'),
	     		$data->_GET('workingDayName'),
	     		$data->_GET('idLevelTraining')
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
		$stm = $this->pdo->Prepare('SELECT * FROM trimester ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new trimestre();
			$usu->_SET('trimesterId', $r->trimesterId);
			$usu->_SET('workingDayName', $r->workingDayName);
			$usu->_SET('idLevelTraining', $r->idLevelTraining);
			
		
		
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($trimesterId){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM trimester where trimesterId=?");

        $stm->execute(array($trimesterId));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new trimestre();
           $usu->_SET('trimesterId', $r->trimesterId);
			$usu->_SET('workingDayName', $r->workingDayName);
			$usu->_SET('idLevelTraining', $r->idLevelTraining);
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(trimestre $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE trimester SET workingDayName= ?, idLevelTraining= ? WHERE trimesterId=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('workingDayName'),
 			$data->_GET('idLevelTraining'),
 			$data->_GET('trimesterId')

 			)
	     	);

	 }catch(exception $e){
	 	die($e->getMessage());
	 }
}

//funciones que permite eliminar los registros

public function eliminar ($trimesterId){
	try{
		$stm= $this->pdo->prepare("DELETE FROM trimester WHERE trimesterId=?");
		$stm->execute(array($trimesterId));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
