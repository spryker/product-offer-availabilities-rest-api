<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\ProductOfferAvailabilitiesRestApi\Api\Storefront\Provider;

use Generated\Api\Storefront\ProductOfferAvailabilitiesStorefrontResource;
use Generated\Shared\Transfer\ProductOfferAvailabilityStorageTransfer;
use Spryker\ApiPlatform\Exception\GlueApiException;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use Spryker\Client\ProductOfferAvailabilityStorage\ProductOfferAvailabilityStorageClientInterface;
use Spryker\Glue\ProductOfferAvailabilitiesRestApi\ProductOfferAvailabilitiesRestApiConfig;
use Symfony\Component\HttpFoundation\Response;

class ProductOfferAvailabilitiesStorefrontProvider extends AbstractStorefrontProvider
{
    protected const string URI_VAR_OFFER_REFERENCE = 'productOfferReference';

    public function __construct(
        protected ProductOfferAvailabilityStorageClientInterface $productOfferAvailabilityStorageClient,
    ) {
    }

    /**
     * @return array<\Generated\Api\Storefront\ProductOfferAvailabilitiesStorefrontResource>
     */
    protected function provideCollection(): array
    {
        if (!$this->hasUriVariable(static::URI_VAR_OFFER_REFERENCE)) {
            $this->throwMissingOfferReference();
        }

        $productOfferReference = (string)$this->getUriVariable(static::URI_VAR_OFFER_REFERENCE);

        if ($productOfferReference === '') {
            $this->throwMissingOfferReference();
        }

        $storeName = $this->getStore()->getNameOrFail();
        $availabilityTransfers = $this->productOfferAvailabilityStorageClient->getByProductOfferReferences(
            [$productOfferReference],
            $storeName,
        );

        if ($availabilityTransfers === []) {
            $this->throwOfferNotFound();
        }

        $availabilityTransfer = null;
        foreach ($availabilityTransfers as $transfer) {
            if ($transfer->getProductOfferReference() === $productOfferReference) {
                $availabilityTransfer = $transfer;

                break;
            }
        }

        if ($availabilityTransfer === null) {
            $this->throwOfferNotFound();
        }

        return [$this->mapToResource($productOfferReference, $availabilityTransfer)];
    }

    /**
     * @throws \Spryker\ApiPlatform\Exception\GlueApiException
     *
     * @return never
     */
    protected function throwMissingOfferReference(): void
    {
        throw new GlueApiException(
            Response::HTTP_BAD_REQUEST,
            ProductOfferAvailabilitiesRestApiConfig::RESPONSE_CODE_PRODUCT_OFFER_ID_IS_NOT_SPECIFIED,
            ProductOfferAvailabilitiesRestApiConfig::RESPONSE_DETAIL_PRODUCT_OFFER_ID_SKU_IS_NOT_SPECIFIED,
        );
    }

    /**
     * @throws \Spryker\ApiPlatform\Exception\GlueApiException
     *
     * @return never
     */
    protected function throwOfferNotFound(): void
    {
        throw new GlueApiException(
            Response::HTTP_NOT_FOUND,
            ProductOfferAvailabilitiesRestApiConfig::RESPONSE_CODE_PRODUCT_OFFER_NOT_FOUND,
            ProductOfferAvailabilitiesRestApiConfig::RESPONSE_DETAIL_PRODUCT_OFFER_NOT_FOUND,
        );
    }

    protected function mapToResource(
        string $productOfferReference,
        ProductOfferAvailabilityStorageTransfer $availabilityTransfer
    ): ProductOfferAvailabilitiesStorefrontResource {
        $availability = $availabilityTransfer->getAvailability();

        $resource = new ProductOfferAvailabilitiesStorefrontResource();
        $resource->productOfferReference = $productOfferReference;
        $resource->isNeverOutOfStock = (bool)$availabilityTransfer->getIsNeverOutOfStock();
        $resource->quantity = $availability?->__toString();
        $resource->availability = ($availability !== null && $availability->greaterThan(0)) || (bool)$availabilityTransfer->getIsNeverOutOfStock();

        return $resource;
    }
}
