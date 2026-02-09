<?php
// Database.php

/**
 * Data Access Layer - Wrapper de PDO para gestión segura de BD.
 */
class Database
{
    // Encapsula la instancia de PDO y el último Statement ejecutado.
    public $connection;
    public $statement;

    /**
     * Inicializa la conexión con configuración optimizada.
     */
    public function __construct($config, $username, $password)
    {
        // Construye DSN dinámico evitando hardcoding de parámetros.
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            // Mapeo automático a arrays asociativos para facilitar el renderizado en vistas.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Lanza excepciones en errores SQL para evitar fallos silenciosos y facilitar debug.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    /**
     * Prepara y ejecuta la sentencia. Retorna $this para permitir encadenamiento (Fluent Interface).
     */
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    /**
     * Retorna la colección completa de resultados.
     */
    public function get()
    {
        return $this->statement->fetchAll();
    }

    /**
     * Retorna un registro único o false si no existe.
     */
    public function find()
    {
        return $this->statement->fetch();
    }

    /**
     * Implementa lógica de "Early Return" con interrupción de flujo 404 si el registro no existe.
     */
    public function findOrFail()
    {
        $results = $this->find();

        if (!$results) {
            abort(Response::NOT_FOUND);
        }

        return $results;
    }
}
