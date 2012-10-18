<?php

/**
 *  @package ThinkFW
 *  @subpackage Abstract
 * @author Willem Daems
 *
 */
abstract class Abstract_Database_Database
{
    private $connection;
    private $config = Array();

    abstract function setConfig(Array $config);
    abstract function connect();
    abstract function disconnect();
    abstract function delete(String $table, $id);
    abstract function update(String $table, $data, $id);
    abstract function query( $query);
    abstract function escape($value);

}