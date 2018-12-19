<?php

class persona{
private $mail;
private $passwordUser;
private $photo;
private $documentName;
private $documentNumber;


public function _get ($k){return $this->$k;}
public function _set ($k,$V){return $this-> $k = $V;}

}



?>