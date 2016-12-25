<?php
/**
 */

namespace Admin;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'categorialivro' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/categorialivro[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'CategoriaLivro\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'livro' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/livro[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Livro\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'usuario' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/usuario[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Usuario\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'locatario' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/locatario[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Locatario\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /admin/:controller/:action
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'categoria_livro_factory' => 'Admin\Factory\CategoriaLivroFactory',
            'livro_factory' => 'Admin\Factory\LivroFactory',
            'usuario_factory' => 'Admin\Factory\UsuarioFactory',
            'locatario_factory' => 'Admin\Factory\LocatarioFactory',
        )
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => Controller\IndexController::class,
            'Admin\Controller\CategoriaLivro' => Controller\CategoriaLivroController::class,
            'Admin\Controller\Livro' => Controller\LivroController::class,
            'Admin\Controller\Usuario' => Controller\UsuarioController::class,
            'Admin\Controller\Locatario' => Controller\LocatarioController::class
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/admin'           => __DIR__ . '/../view/layout/admin.phtml',
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helper_config' => array(
        'flashmessenger' => array(
            'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>',
            'message_close_string'     => '</p></div>',
            'message_separator_string' => '</p><p>'
        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            'app_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/src/Admin/Model')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Admin\Model' => 'app_driver'
                )
            )
        )
    )
);
