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
use Glavweb\CmsRestClient\CmsRestClient;

/**
 * CmsRestClientServiceProvider
 *
 * @package Glavweb\SilexCms
 * @author Andrey Nilov <nilov@glavweb.ru>
 */
class CmsRestClientServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['cms.rest_client'] = function () use ($app) {
            return new CmsRestClient(
                $app['guzzle'],
                $app['cms.api_url'],
                $app['cms.api_username'],
                $app['cms.api_password']
            );
        };
    }
}
