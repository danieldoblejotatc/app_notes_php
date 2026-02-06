<?php

/**
 * Gestor de conexión y consultas a la base de datos mediante PDO.
 */
class Database
{
    public $connection;

    /**
     * Inicializa la conexión con el motor MySQL.
     * @param array $config Parámetros de conexión (host, dbname, charset, etc).
     */
    public function __construct($config, $username, $password)
    {
        // Construye el DSN dinámicamente a partir de un arreglo asociativo
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        // dd($dsn);

        $this->connection = new PDO($dsn, $username, $password, [
            // Retorna resultados como arreglos asociativos por defecto
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Lanza excepciones en caso de errores SQL para un manejo robusto
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    /**
     * Ejecuta sentencias preparadas para mitigar riesgos de SQL Injection.
     * @param string $query Sentencia SQL con placeholders.
     * @param array $params Valores vinculados a la consulta.
     */
    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
    }
}
