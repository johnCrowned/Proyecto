<?php

class documentType{
private $documentName;
private $description;
private $statusDocType;

public function _get ($k){return $this->$k;}
public function _set ($k,$V){return $this-> $k = $V;}

}


?>