<?php
/**
 */

namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $e->getViewModel()->setTemplate('layout/admin');

        $eventManager->attach(MvcEvent::EVENT_ROUTE,
            function($e) {
                $auth = $e->getApplication()->getServiceManager()->get('Zend\Authentication\AuthenticationService');
                
                $match = $e->getRouteMatch();
                
                $name = $match->getMatchedRouteName();
                
                $whitelist = array('login', 'home');
                
                // Route is whitelisted
                $name = $match->getMatchedRouteName();
                if (in_array($name, $whitelist)) {
                    return;
                }

                if (!$auth->hasIdentity()) {
                    $router   = $e->getRouter();
                    $url      = $router->assemble(array(), array(
                        'name' => 'login'
                    ));
        
                    $response = $e->getResponse();
                    $response->getHeaders()->addHeaderLine('Location', $url);
                    $response->setStatusCode(302);
        
                    return $response;
                }
            }
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'formataCPF' => function($sm) {
                    return new Helper\FormataCPF;
                },
                'formataData' => function($sm) {
                    return new Helper\FormataData;
                },
                'formataMoeda' => function($sm) {
                    return new Helper\FormataMoeda;
                },
            )
        );   
   }
}
