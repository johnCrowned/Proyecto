<?php

class ObservationItem{
private $observationId;
private $observation;
private $jury;
private $dateOI;
private $userOI;
private $fichaNumber;
private $groupCode;
private $itemId;
private $listId;


public function _get ($k){return $this->$k;}
public function _set ($k,$V){return $this-> $k = $V;}

}


?>