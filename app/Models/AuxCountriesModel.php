<?php

declare(strict_types = 1);

namespace Com\Daw2\Models;

class AuxCountriesModel extends \Com\Daw2\Core\BaseDbModel{ 
    
    function getAll() : array{
        return $this->pdo->query("SELECT * FROM aux_countries ORDER BY country_name")->fetchAll();
    }
}