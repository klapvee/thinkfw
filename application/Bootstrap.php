<?php

/**
 * class Bootstrap
 *
 * @package ThinkFW
 * @subpackage Bootstrap
 * @author Willem Daems
 *
 *
 */
class Bootstrap
{
    /**
     * Array containing configuration
     * options from ini file
     *
     * @var array
     */
    private $config;

    /**
     * Error handler object
     *
     * @var Handler_ErrorHandler
     */
    private $errorHandler;

    /**
     * Abstract_Database_Database
     *
     * @var type
     */
    private $connection;

    /**
     * @return void
     *
     */
    public  function __construct()
    {
        $this->errorHandler = new Handler_ErrorHandler();
        $this->config = parse_ini_file(APPLICATION_PATH . "/configs/siteconfig.ini", true);
    }

    /**
     *
     * @return void
     */
    public function boot()
    {
        // start session
        @session_start();

        // init db connection
        try {
            $dao = "Dao_" . ucfirst($this->config['DATABASE']['driver']);
            $this->connection = new $dao;
            $this->connection->setConfig(($this->config['DATABASE']));
            $this->connection->connect();

            Base_Application::setDatabase($this->connection);

        } catch (Exception $e) {

        }
    }
}