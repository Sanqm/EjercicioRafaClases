<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use \PDO;

class UsuarioModel extends \Com\Daw2\Core\BaseDbModel {

    const SELECT_FROM = "SELECT u.*, ar.nombre_rol as rol, ac.country_name FROM usuario u LEFT JOIN aux_rol ar ON ar.id_rol = u.id_rol LEFT JOIN aux_countries ac ON u.id_country = ac.id";

    public $cambioOrdenacion = true;

    function getAllUsers(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM);
        return $stmt->fetchAll();
    }

    function getAllUserOrderBySalar(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM . " ORDER BY salarioBruto DESC");
        return $stmt->fetchAll();
    }

    function getStandardUsers(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM . " WHERE nombre_rol = 'standard'");
        return $stmt->fetchAll();
    }

    function getUsersNameCarlos(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM . " WHERE username LIKE 'carlos%'");
        return $stmt->fetchAll();
    }

    private function executeQuery(string $query, array $vars): array {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($vars);
        return $stmt->fetchAll();
    }

    function filter(array $filtros): array {
        $condiciones = [];
        $vars = [];
        $metodo = "";
        $ordenado = " username";

        if (!empty($filtros['id_rol']) && filter_var($filtros['id_rol'], FILTER_VALIDATE_INT)) {
            $condiciones[] = 'u.id_rol = :id_rol';
            $vars['id_rol'] = $filtros['id_rol'];
        }
        if (!empty($filtros['username'])) {
            $condiciones[] = 'username LIKE :username';
            $vars['username'] = "%$filtros[username]%";
        }
        if (!empty($filtros['min_salar']) && is_numeric($filtros['min_salar'])) {
            $condiciones[] = 'salarioBruto >= :min_salar';
            $vars['min_salar'] = $filtros['min_salar'];
        }
        if (!empty($filtros['max_salar']) && is_numeric($filtros['max_salar'])) {
            $condiciones[] = 'salarioBruto <= :max_salar';
            $vars['max_salar'] = $filtros['max_salar'];
        }
        if (!empty($filtros['min_ret']) && is_numeric($filtros['min_ret'])) {
            $condiciones[] = 'retencionIRPF >= :min_ret';
            $vars['min_ret'] = $filtros['min_ret'];
        }
        if (!empty($filtros['max_ret']) && is_numeric($filtros['max_ret'])) {
            $condiciones[] = 'retencionIRPF <= :max_ret';
            $vars['max_ret'] = $filtros['max_ret'];
        }
        if (!empty($filtros['id_country']) && is_array($filtros['id_country'])) {
            $ids = [];
            $bind = [];
            $i = 1;
            foreach ($filtros['id_country'] as $c) {
                $key = 'id_country' . $i;
                $ids[] = ":$key";
                $bind[$key] = $c;
                $i++;
            }
            $condiciones[] = "id_country IN (" . implode(", ", $ids) . ")";
            $vars = array_merge($vars, $bind);
        }

        if (isset($filtros['ordenar'])) {
            $ordenado = $filtros['ordenar'];

        }




        if (empty($condiciones)) {
            $query = self::SELECT_FROM . " ORDER BY $ordenado" . "$metodo";
            return $this->pdo->query($query)->fetchAll();
        } else {
            $query = self::SELECT_FROM . " WHERE " . implode(" AND ", $condiciones) . " ORDER BY $ordenado" . "$metodo";
            return $this->executeQuery($query, $vars);
        }
    }

}
