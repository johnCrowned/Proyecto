<?php
class FichaListClass{
	private $pdo;

	public function __CONSTRUCT(){
	try{
	$this ->pdo=database::conectar();
	}catch(Exception $ex){
	die($e->getMessage());
	}
	}




//Funcion que ingresa o almacena los registros de ingeso en el formuilario//

public function Registrar(FichaList $data){
	
	try{
		$sql = "INSERT INTO fichahaschecklist (fichaNumber,listId)
		VALUES(?,?)";



	$this->pdo->prepare($sql)
	     ->execute(
	     	array(
	     		$data->_GET('fichaNumber'),
	     		$data->_GET('listId'),
	     		
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
		$stm = $this->pdo->Prepare('SELECT * FROM fichahaschecklist ');
		$stm->execute();

		foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
			$usu = new FichaList();
			$usu->_SET('fichaNumber', $r->fichaNumber);
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

public function obtener($fichaNumber){
	try{
		$stm=$this->pdo
                  ->prepare("SELECT * FROM fichahaschecklist where fichaNumber=?");

        $stm->execute(array($fichaNumber));
        $r = $stm ->fetch(PDO::FETCH_OBJ);

        $usu= new FichaList();

        $usu->_SET('fichaNumber', $r->fichaNumber );
		$usu->_SET('listId', $r->listId );
		

		return $usu;

	}catch(Exception $e){
		die($e-> getMessage());
	}
}

//funcion que permite actualizar los registros de cargado en la funcion obtener

public function Actualizar(FichaList $data){

	//var_dump($data);
	//exit();

	try{
		 $sql="UPDATE fichahaschecklist SET listId= ? WHERE fichaNumber=?";
	$this->pdo->prepare($sql)->execute(
		array(
			$data->_GET('listId'),
 			$data->_GET('fichaNumber')

 			)
	     	);
	 }catch(Exception $e){
	 	die($e->getMessage());
	 }
}
//funciones que permite eliminar los registros

public function eliminar ($fichaNumber){
	try{
		$stm= $this->pdo->prepare("DELETE FROM fichahaschecklist WHERE fichaNumber=?");
		$stm->execute(array($fichaNumber));
	}catch(Exception$e){
		die($e->getMessage());
	}
}
}