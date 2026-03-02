<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\Reader;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ProductOfferAvailabilityReaderInterface
{
    public function getProductOfferAvailabilities(RestRequestInterface $restRequest): RestResponseInterface;

    /**
     * @param array<string> $productOfferReferences
     *
     * @return array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface>
     */
    public function getProductOfferAvailabilityRestResources(array $productOfferReferences): array;
}
