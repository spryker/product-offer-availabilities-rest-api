<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductOfferAvailabilitiesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class ProductOfferAvailabilitiesRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_PRODUCT_OFFER_AVAILABILITIES = 'product-offer-availabilities';

    /**
     * @uses \Spryker\Glue\MerchantProductOffersRestApi\MerchantProductOffersRestApiConfig::RESOURCE_PRODUCT_OFFERS
     *
     * @var string
     */
    public const RESOURCE_PRODUCT_OFFERS = 'product-offers';

    /**
     * @api
     *
     * @uses \Spryker\Glue\MerchantProductOffersRestApi\MerchantProductOffersRestApiConfig::RESPONSE_CODE_PRODUCT_OFFER_NOT_FOUND
     *
     * @var string
     */
    public const RESPONSE_CODE_PRODUCT_OFFER_NOT_FOUND = '3701';

    /**
     * @api
     *
     * @uses \Spryker\Glue\MerchantProductOffersRestApi\MerchantProductOffersRestApiConfig::RESPONSE_DETAIL_PRODUCT_OFFER_NOT_FOUND
     *
     * @var string
     */
    public const RESPONSE_DETAIL_PRODUCT_OFFER_NOT_FOUND = 'Product offer was not found.';

    /**
     * @uses \Spryker\Glue\MerchantProductOffersRestApi\MerchantProductOffersRestApiConfig::RESPONSE_CODE_PRODUCT_OFFER_ID_IS_NOT_SPECIFIED
     *
     * @var string
     */
    public const RESPONSE_CODE_PRODUCT_OFFER_ID_IS_NOT_SPECIFIED = '3702';

    /**
     * @uses \Spryker\Glue\MerchantProductOffersRestApi\MerchantProductOffersRestApiConfig::RESPONSE_DETAIL_PRODUCT_OFFER_ID_SKU_IS_NOT_SPECIFIED
     *
     * @var string
     */
    public const RESPONSE_DETAIL_PRODUCT_OFFER_ID_SKU_IS_NOT_SPECIFIED = 'Product offer ID is not specified.';
}
