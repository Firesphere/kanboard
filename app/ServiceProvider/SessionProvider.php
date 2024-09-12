<?php

namespace Kanboard\ServiceProvider;

use Kanboard\Core\Session\FlashMessage;
use Kanboard\Core\Session\SessionManager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Session Provider
 *
 * @package Kanboard\ServiceProvider
 * @author  Frederic Guillot
 */
class SessionProvider implements ServiceProviderInterface
{
    /**
     * Register providers
     *
     * @access public
     * @param \Pimple\Container $container
     * @return \Pimple\Container
     */
    public function register(Container $container)
    {
        $container['sessionManager'] = function ($c) {
            return new SessionManager($c);
        };

        $container['flash'] = function ($c) {
            return new FlashMessage($c);
        };

        return $container;
    }
}
