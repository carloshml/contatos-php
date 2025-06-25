<?php

class Banco
{
    private static $dbNome = 'phpCRUD';
    private static $dbHost = 'localhost';
    private static $dbUsuario = 'root';
    private static $dbSenha = '';
    private static $charset = 'utf8mb4';

    private static $cont = null;

    function __construct()
    {
        // Protected constructor to prevent instantiation
    }

    public static function conectar()
    {
        if (self::$cont === null) {
            $dsn = "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbNome . ";charset=" . self::$charset;

            try {
                self::$cont = new PDO($dsn, self::$dbUsuario, self::$dbSenha, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                // Consider logging this instead in production
                die('Erro ao conectar com o banco: ' . $e->getMessage());
            }
        }

        return self::$cont;
    }

    public static function desconectar()
    {
        self::$cont = null;
    }
}