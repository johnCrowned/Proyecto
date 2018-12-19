<?php

class GeneralObservation{
private $observationId;
private $observation;
private $jury;
private $dateGO;
private $userGO;
private $fichaNumber;
private $groupCode;

public function _get ($k){return $this->$k;}
public function _set ($k,$V){return $this-> $k = $V;}

}


?>