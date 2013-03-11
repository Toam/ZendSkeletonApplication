<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'bjyauthorize' => array(
        // default role for unauthenticated users
        'default_role'          => 'guest',

        // default role for authenticated users (if using the
        // 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider' identity provider)
        'authenticated_role'    => 'user',

        // identity provider service name
        'identity_provider'     => 'BjyAuthorize\Provider\Identity\ZfcUserZendDb',

        // Role providers to be used to load all available roles into Zend\Permissions\Acl\Acl
        // Keys are the provider service names, values are the options to be passed to the provider
        'role_providers'        => array(
            'BjyAuthorize\Provider\Role\Config' => array(
                'guest' => array(),
                'user'  => array('children' => array(
                    'admin' => array(),
                )),
            ),

            'BjyAuthorize\Provider\Role\ZendDb' => array(
                'table'             => 'user_role',
                'role_id_field'     => 'role_id',
                'parent_role_field' => 'parent',
            )
        ),

        // Resource providers to be used to load all available resources into Zend\Permissions\Acl\Acl
        // Keys are the provider service names, values are the options to be passed to the provider
        'resource_providers'    => array(),

        // Rule providers to be used to load all available rules into Zend\Permissions\Acl\Acl
        // Keys are the provider service names, values are the options to be passed to the provider
        'rule_providers'        => array(),

        // Guard listeners to be attached to the application event manager
        'guards'                => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all controllers and actions unless they are specified here.
             * You may omit the 'action' index to allow access to the entire controller
             */
            'BjyAuthorize\Guard\Controller' => array(
                #array('controller' => 'index', 'action' => 'index', 'roles' => array('guest','user')),
                #array('controller' => 'index', 'action' => 'stuff', 'roles' => array('user')),
                array('controller' => 'zfcuser', 'roles' => array()),
                array('controller' => 'Application\Controller\Index', 'roles' => array('guest', 'user')),
                array('controller' => 'Application\Controller\Expediteur', 'roles' => array('guest', 'user')),
                array('controller' => 'Application\Controller\Bon', 'roles' => array('guest', 'user')),
                array('controller' => 'Application\Controller\User', 'roles' => array('guest', 'user')),
                
            ),
        ),

        // strategy service name for the strategy listener to be used when permission-related errors are detected
        'unauthorized_strategy' => 'BjyAuthorize\View\UnauthorizedStrategy',

        // Template name for the unauthorized strategy
        'template'              => 'error/403',
    ),

    'service_manager' => array(
        'factories' => array(
            'BjyAuthorize\Service\Authorize' => 'BjyAuthorize\Service\AuthorizeFactory',
            'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider'
                => 'BjyAuthorize\Service\AuthenticationIdentityProviderServiceFactory',
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider'
                => 'BjyAuthorize\Service\ObjectRepositoryRoleProviderFactory',
        ),
        'aliases' => array(
            'bjyauthorize_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ),
    ),

    // 'view_manager' => array(
    //     'template_map' => array(
    //         'error/403' => __DIR__ . '/../../view/error/403.phtml',
    //         'zend-developer-tools/toolbar/bjy-authorize-role'
    //             => __DIR__ . '/../../view/zend-developer-tools/toolbar/bjy-authorize-role.phtml',
    //     ),
    // ),

    'zenddevelopertools' => array(
        'profiler' => array(
            'collectors' => array(
                'bjy_authorize_role_collector' => 'BjyAuthorize\\Collector\\RoleCollector',
            ),
        ),
        'toolbar' => array(
            'entries' => array(
                'bjy_authorize_role_collector' => 'zend-developer-tools/toolbar/bjy-authorize-role',
            ),
        ),
    ),
);
