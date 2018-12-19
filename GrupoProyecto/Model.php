<?php
class grupoClas{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}






//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function registrar(grupo $data){
	try{
		$sql = "INSERT INTO projectgroup (groupCode,fichaNumber,proyectName,statusP)
		VALUES(?,?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('groupCode'),
	     		$data->_GET('fichaNumber'),
	     		$data->_GET('proyectName'),
	     		$data->_GET('statusP')
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
		$stm = $this->pdo->Prepare('SELECT * FROM projectgroup ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new grupo();
			$usu->_SET('groupCode', $r->groupCode);
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('proyectName', $r->proyectName);
			$usu->_SET('statusP', $r->statusP);
		
		
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($groupCode){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM projectgroup where groupCode=?");

        $stm->execute(array($groupCode));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new grupo();
         $usu->_SET('groupCode', $r->groupCode);
			$usu->_SET('fichaNumber', $r->fichaNumber);
			$usu->_SET('proyectName', $r->proyectName);
			$usu->_SET('statusP', $r->statusP);
	

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(grupo $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE projectgroup SET fichaNumber=?,proyectName=?, statusP=? WHERE groupCode=?";
	$this->pdo->prepare($sql)->execute(
		array(
 			$data->_GET('fichaNumber'),
 			$data->_GET('proyectName'),
 			$data->_GET('statusP'),
 			$data->_GET('groupCode')

 			)
	     	);

	 }catch(exception $e){
	 	die($e->getMessage());
	 }
}

//funciones que permite eliminar los registros

public function eliminar ($groupCode){
	try{
		$stm= $this->pdo->prepare("DELETE FROM projectgroup WHERE groupCode=?");
		$stm->execute(array($groupCode));
	}catch(Exception$e){
		die($e->getMessage());
	}
}

}
?>
