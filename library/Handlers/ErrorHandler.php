<?php

/**
 * Class Handler_ErrorHandler
 *
 * @package ThinkFW
 * @subpackage Handler
 * @author Willem Daems
 *
 */
class Handler_ErrorHandler
{
    /**
     *
     * @var boolean
     */
    private $debug;

    /**
     * @return void
     *
     */
    public function __construct()
    {
        $this->debug = false;
        set_error_handler(array($this, 'handler'), E_STRICT);
    }

    /**
     *
     * @param string $errorType
     * @param string $errorString
     * @param string $errorFile
     * @param string $errorLine
     * @return boolean
     */
    public function handler($errorType, $errorString, $errorFile, $errorLine)
    {
        switch ($errorType) {

            case E_ERROR:
                if (!$this->debug) {
                    echo "Oh my, there is an error in your file";
                } else {
                    echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
                    echo "  Fatal error on line $errline in file $errfile";
                    echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
                    echo "Aborting...<br />\n";
                    exit(1);
                    break;
                }
                break;
            case E_WARNING:
                if (!$this->debug) {
                    echo "You got off with a warning. Let this be a lesson for you young man!";
                } else {

                }
                break;
        case E_NOTICE:
            if (!$this->debug) {
                echo "You got off with a warning. Let this be a lesson for you young man!";
            } else {

            }
            break;
        case E_PARSE:
            if (!$this->debug) {
                echo "You got off with a warning. Let this be a lesson for you young man!";
            } else {

            }
            break;
        default:
            //echo 'skipped' . $errorType;
            break;

        }
        // let the php error handler know that the problem is taken care off
        return true;
    }
}