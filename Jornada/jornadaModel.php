<?php
class jornadaModel{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(workingDay $data){
	try{
		$sql = "INSERT INTO workingDay (workingDayName,statusW,description)
		VALUES(?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('workingDayName'),
	     		$data->_GET('statusW'),
	     		$data->_GET('description'),
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
		$stm = $this->pdo->Prepare('SELECT * FROM workingDay ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new workingDay();
			$usu->_SET('workingDayName', $r->workingDayName);
			$usu->_SET('statusW', $r->statusW);
			$usu->_SET('description', $r->description);
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($workingDayName){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM workingDay where workingDayName=?");

        $stm->execute(array($workingDayName));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new workingDay();

        $usu->_SET('workingDayName', $r->workingDayName );
		$usu->_SET('statusW', $r->statusW );
		$usu->_SET('description', $r->description );

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(workingDay $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE workingDay SET description= ?, statusW= ? WHERE workingDayName=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('description'),
 			$data->_GET('statusW'),
 			$data->_GET('workingDayName')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($workingDayName){
	try{
		$stm= $this->pdo->prepare("DELETE FROM workingDay WHERE workingDayName=?");
		$stm->execute(array($workingDayName));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}
?>
