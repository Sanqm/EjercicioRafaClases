<?php

namespace Com\Daw2\Core;

use \PDO;

abstract class BaseDbModel{
    
    protected $pdo;
    
    public function __construct() {
        $this->pdo = DBManager::getInstance()->getConnection();
    }        
}


