<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductOfferAvailabilitiesRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Dependency\Client\ProductOfferAvailabilitiesRestApiToProductOfferAvailabilityStorageClientBridge;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Dependency\Client\ProductOfferAvailabilitiesRestApiToStoreClientBridge;

/**
 * @method \Spryker\Glue\ProductOfferAvailabilitiesRestApi\ProductOfferAvailabilitiesRestApiConfig getConfig()
 */
class ProductOfferAvailabilitiesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_STORE = 'CLIENT_STORE';

    /**
     * @var string
     */
    public const CLIENT_PRODUCT_OFFER_AVAILABILITY_STORAGE = 'CLIENT_PRODUCT_OFFER_AVAILABILITY_STORAGE';

    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addProductOfferAvailabilityStorageClient($container);
        $container = $this->addStoreClient($container);

        return $container;
    }

    protected function addProductOfferAvailabilityStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_PRODUCT_OFFER_AVAILABILITY_STORAGE, function (Container $container) {
            return new ProductOfferAvailabilitiesRestApiToProductOfferAvailabilityStorageClientBridge(
                $container->getLocator()->productOfferAvailabilityStorage()->client(),
            );
        });

        return $container;
    }

    protected function addStoreClient(Container $container): Container
    {
        $container->set(static::CLIENT_STORE, function (Container $container) {
            return new ProductOfferAvailabilitiesRestApiToStoreClientBridge(
                $container->getLocator()->store()->client(),
            );
        });

        return $container;
    }
}
