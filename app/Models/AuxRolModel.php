<?php
declare(strict_types = 1);

namespace Com\Daw2\Models;

class AuxRolModel extends \Com\Daw2\Core\BaseDbModel{ 
    
    const SELECT_FROM = "SELECT * FROM aux_rol";
    
    public function getAll() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM . " ORDER BY nombre_rol");
        return $stmt->fetchAll();
    }
}       
