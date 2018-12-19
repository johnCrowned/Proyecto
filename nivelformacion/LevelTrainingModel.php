<?php
class LevelTrainingModel{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(LevelTraining $data){
	
	try{
		$sql = "INSERT INTO LevelTraining (idLevelTraining,descripcion,state)
		VALUES(?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('idLevelTraining'),
	     		$data->_GET('descripcion'),
	     		$data->_GET('state'),
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
		$stm = $this->pdo->Prepare('SELECT * FROM LevelTraining ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new LevelTraining();
			$usu->_SET('idLevelTraining', $r->idLevelTraining);
			$usu->_SET('descripcion', $r->descripcion);
			$usu->_SET('state', $r->state);
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($idLevelTraining){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM LevelTraining where idLevelTraining=?");

        $stm->execute(array($idLevelTraining));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new LevelTraining();

        $usu->_SET('idLevelTraining', $r->idLevelTraining );
		$usu->_SET('descripcion', $r->descripcion );
		$usu->_SET('state', $r->state );

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(LevelTraining $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE LevelTraining SET descripcion= ?, state= ? WHERE idLevelTraining=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('descripcion'),
 			$data->_GET('state'),
 			$data->_GET('idLevelTraining')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($idLevelTraining){
	try{
		$stm= $this->pdo->prepare("DELETE FROM LevelTraining WHERE idLevelTraining=?");
		$stm->execute(array($idLevelTraining));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}
?>