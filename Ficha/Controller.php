<?php

class ficha{
private $fichaNumber;
private $statusf;
private $programCode_version;
private $workingDayName;
private $programName;

public function _get ($k){return $this->$k;}
public function _set ($k,$V){return $this-> $k = $V;}

}


?>