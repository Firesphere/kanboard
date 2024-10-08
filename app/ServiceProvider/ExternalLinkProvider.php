<?php

namespace Kanboard\ServiceProvider;

use Kanboard\Core\ExternalLink\ExternalLinkManager;
use Kanboard\ExternalLink\AttachmentLinkProvider;
use Kanboard\ExternalLink\FileLinkProvider;
use Kanboard\ExternalLink\WebLinkProvider;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * External Link Provider
 *
 * @package Kanboard\ServiceProvider
 * @author  Frederic Guillot
 */
class ExternalLinkProvider implements ServiceProviderInterface
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
        $container['externalLinkManager'] = new ExternalLinkManager($container);
        $container['externalLinkManager']->register(new WebLinkProvider($container));
        $container['externalLinkManager']->register(new AttachmentLinkProvider($container));
        $container['externalLinkManager']->register(new FileLinkProvider($container));

        return $container;
    }
}
