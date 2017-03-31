<?php

/*
 * This file is part of the GLAVWEB.cms SilexCms package.
 *
 * (c) Andrey Nilov <nilov@glavweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glavweb\SilexCms\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Glavweb\CmsContentBlock\Manager\ContentBlockManager;
use Glavweb\CmsContentBlock\Manager\OptionManager;

/**
 * ContentBlockServiceProvider
 *
 * @package Glavweb\SilexCms
 * @author Andrey Nilov <nilov@glavweb.ru>
 */
class ContentBlockServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['cms.content_block.manager'] = function () use ($app) {
            return new ContentBlockManager(
                $app['cms.rest_client']
            );
        };

        $app['cms.content_block.option_manager'] = function () use ($app) {
            return new OptionManager(
                $app['cms.rest_client']
            );
        };
    }
}
