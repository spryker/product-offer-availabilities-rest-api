<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductOfferAvailabilitiesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ProductOfferAvailabilityStorageTransfer;
use Generated\Shared\Transfer\RestProductOfferAvailabilitiesAttributesTransfer;

class ProductOfferAvailabilityMapper implements ProductOfferAvailabilityMapperInterface
{
    public function mapProductOfferAvailabilityStorageTransferToRestProductOfferAvailabilitiesAttributesTransfer(
        ProductOfferAvailabilityStorageTransfer $productOfferAvailabilityStorageTransfer,
        RestProductOfferAvailabilitiesAttributesTransfer $restProductOfferAvailabilitiesAttributesTransfer
    ): RestProductOfferAvailabilitiesAttributesTransfer {
        return $restProductOfferAvailabilitiesAttributesTransfer
            ->fromArray($productOfferAvailabilityStorageTransfer->toArray(), true)
            ->setAvailability($productOfferAvailabilityStorageTransfer->getIsAvailable())
            ->setQuantity($productOfferAvailabilityStorageTransfer->getAvailability());
    }
}
