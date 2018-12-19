<?php

class fichaInstructor{
private $documentNumber;
private $documentName;
private $fichaNumber;
private $trimesterId;
private $workingDayName;
private $idLevelTraining;
private $insTypeld;

public function _get ($k){return $this->$k;}
public function _set ($k,$V){return $this-> $k = $V;}

}


?>