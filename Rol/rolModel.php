<?php
class rolModel{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(role $data){
	
	try{
		$sql = "INSERT INTO role (roleId,description,statusRole)
		VALUES(?,?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('roleId'),
	     		$data->_GET('description'),
	     		$data->_GET('statusRole'),
	     		
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
		$stm = $this->pdo->Prepare('SELECT * FROM role ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new role();
			$usu->_SET('roleId', $r->roleId);
			$usu->_SET('description', $r->description);
			$usu->_SET('statusRole', $r->statusRole);
			
			
			$result[] = $usu;
		}
		return $result;
	}
	catch(Exception $e){
		die ($e->getMessage());
	}
}


//Funcion que permite cargar o listar  registros en el formulario para modificarlos

public function obtener($roleId){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM role where roleId=?");

        $stm->execute(array($roleId));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new role();

			$usu->_SET('roleId', $r->roleId);
			$usu->_SET('description', $r->description);
			$usu->_SET('statusRole', $r->statusRole);
		

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(role $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE role SET description= ?,statusRole= ? WHERE roleId=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('description'),
 			$data->_GET('statusRole'),
 			$data->_GET('roleId')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($roleId){
	try{
		$stm= $this->pdo->prepare("DELETE FROM role WHERE roleId=?");
		$stm->execute(array($roleId));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}
?>