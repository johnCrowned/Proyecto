<?php

class role{
private $roleId;
private $statusRole;
private $description;


public function _get ($k){return $this->$k;}
public function _set ($k,$V){return $this-> $k = $V;}

}


?>