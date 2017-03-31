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

use Glavweb\MarkupFixture\Helper\MarkupFixtureHelper;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Glavweb\CmsCompositeObject\Manager\CompositeObjectManager;

/**
 * CompositeObjectServiceProvider
 *
 * @package Glavweb\SilexCms
 * @author Andrey Nilov <nilov@glavweb.ru>
 */
class CompositeObjectServiceProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    private $hostUrl;

    /**
     * @var bool
     */
    private $markupMode;

    /**
     * @var array
     */
    private $fixtureObjects;

    /**
     * CompositeObjectServiceProvider constructor.
     *
     * @param string $hostUrl
     * @param bool   $markupMode
     * @param array  $fixtureObjects
     */
    public function __construct($hostUrl = null, $markupMode = false, $fixtureObjects = [])
    {
        $this->hostUrl        = $hostUrl;
        $this->markupMode     = $markupMode;
        $this->fixtureObjects = $fixtureObjects;
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['cms.composite_object.manager'] = function () use ($app) {
            $hostUrl = $this->hostUrl ?: $app['request.host_url'];
            $markupFixtureHelper = new MarkupFixtureHelper($hostUrl);

            return new CompositeObjectManager(
                $app['cms.rest_client'],
                $markupFixtureHelper,
                $this->markupMode,
                $this->fixtureObjects
            );
        };
    }
}
