<?php

include_once '/../config.php';

/**
 * PDO class for connection
 *
 * @author Hardik Patel <hardik@techdefence.com>
 */
abstract class Db
{

    /**
     * Host name
     * @var string 
     */
    private $ssHost;

    /**
     * Username of mysql
     * @var string 
     */
    private $ssUsername;

    /**
     * Password of mysql
     * @var string 
     */
    private $ssPasswrod;

    /**
     * Database name 
     * @var string 
     */
    private $ssDbname;

    /**
     * Connection object
     * @var object 
     */
    protected $obCon = '';

    /**
     * MySql Port 
     * @var int 
     */
    private $snPort;

    /**
     * Debug
     * @var object 
     */
    private $obDebug;

    /**
     * Default Constructer
     */
    public function __construct()
    {
        $this->ssHost = HOST;
        $this->ssUsername = USERNAME;
        $this->ssPasswrod = PASSWORD;
        $this->ssDbname = DBNAME;
        $this->snPort = PORT;
        $this->obDebug = true;
        $this->connect();
    }

    /**
     * Function to connect the database and create connection object
     * @return boolean
     */
    public function connect()
    {

        if (!$this->obCon)
        {

            try
            {

                $this->obCon = new PDO('mysql:host=' . $this->ssHost . ';dbname=' . $this->ssDbname, $this->ssUsername, $this->ssPasswrod);

                $this->obCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (Exception $ex)
            {

                die('Error : ' . $ex->getMessage());
            }
            if (!$this->obCon)
            {
                echo 'Connection BDD failed';
                die();
            }
        }

        return $this->obCon;
    }

    /**
     * Function to disconnect mysql pdo connection
     */
    public function disconnect()
    {
        if ($this->obCon)
        {
            $this->obCon = NULL;
        }
    }

    /**
     * Function to destroy the connection object
     */
    public function __destruct()
    {
        $this->disconnect();
    }

}
