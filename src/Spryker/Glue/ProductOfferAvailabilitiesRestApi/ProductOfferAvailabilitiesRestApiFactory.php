<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductOfferAvailabilitiesRestApi;

use Spryker\Glue\Kernel\AbstractFactory;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Dependency\Client\ProductOfferAvailabilitiesRestApiToProductOfferAvailabilityStorageClientInterface;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Dependency\Client\ProductOfferAvailabilitiesRestApiToStoreClientInterface;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\Expander\ProductOfferAvailabilityExpander;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\Expander\ProductOfferAvailabilityExpanderInterface;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\Mapper\ProductOfferAvailabilityMapper;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\Mapper\ProductOfferAvailabilityMapperInterface;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\Reader\ProductOfferAvailabilityReader;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\Reader\ProductOfferAvailabilityReaderInterface;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\RestResponseBuilder\ProductOfferAvailabilityRestResponseBuilder;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\RestResponseBuilder\ProductOfferAvailabilityRestResponseBuilderInterface;

class ProductOfferAvailabilitiesRestApiFactory extends AbstractFactory
{
    public function createProductOfferAvailabilityReader(): ProductOfferAvailabilityReaderInterface
    {
        return new ProductOfferAvailabilityReader(
            $this->getProductOfferAvailabilityStorageClient(),
            $this->getStoreClient(),
            $this->createProductOfferAvailabilityRestResponseBuilder(),
        );
    }

    public function createProductOfferAvailabilityMapper(): ProductOfferAvailabilityMapperInterface
    {
        return new ProductOfferAvailabilityMapper();
    }

    public function createProductOfferAvailabilityRestResponseBuilder(): ProductOfferAvailabilityRestResponseBuilderInterface
    {
        return new ProductOfferAvailabilityRestResponseBuilder(
            $this->getResourceBuilder(),
            $this->createProductOfferAvailabilityMapper(),
        );
    }

    public function getProductOfferAvailabilityStorageClient(): ProductOfferAvailabilitiesRestApiToProductOfferAvailabilityStorageClientInterface
    {
        return $this->getProvidedDependency(ProductOfferAvailabilitiesRestApiDependencyProvider::CLIENT_PRODUCT_OFFER_AVAILABILITY_STORAGE);
    }

    public function getStoreClient(): ProductOfferAvailabilitiesRestApiToStoreClientInterface
    {
        return $this->getProvidedDependency(ProductOfferAvailabilitiesRestApiDependencyProvider::CLIENT_STORE);
    }

    public function createProductOfferAvailabilityExpander(): ProductOfferAvailabilityExpanderInterface
    {
        return new ProductOfferAvailabilityExpander(
            $this->createProductOfferAvailabilityReader(),
        );
    }
}
