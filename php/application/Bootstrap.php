<?php
require_once ('Library.php');

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    #stores a copy of the config object in the Registry for future references
    #!IMPORTANT: Must be runed before any other inits
    protected function _initConfig()
    {
        Zend_Registry::set('config', new Zend_Config($this->getOptions()));
    }

    protected function _initDebug()
    {
        $config = Zend_Registry::get('config');

        if (isset($config->settings->debug->enabled)) {
            if ($config->settings->debug->enabled == TRUE) {
                define('DEBUG', TRUE);
            } else {
                if (isset($config->settings->debug->cookie)) {
                    $debug_cookie = $config->settings->debug->cookie;

                    if (array_key_exists($debug_cookie, $_COOKIE)) {
                        define('DEBUG', TRUE);
                    }
                }
            }
        }

        if (FALSE === defined('DEBUG')) {
            define('DEBUG', FALSE);
        }

        $logger = new Zend_Log();
        $writer = new Zend_Log_Writer_Firebug();
        $logger->addWriter($writer);

        Zend_Registry::set('logger', $logger);

        $logger->info('Informational message');
    }

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }


}
