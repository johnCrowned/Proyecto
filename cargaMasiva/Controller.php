<?php

class persona{
private $documentNumber;
private $firstName;
private $secondName;
private $firstLastName;
private $secondLastName;
private $documentName;
private $passwordUser;
private $photo;
private $mail;
private $statusCustomerRole;
private $roleId;
private $terminationDate;


public function _get ($k){return $this->$k;}
public function _set ($k,$V){return $this-> $k = $V;}

}


?>