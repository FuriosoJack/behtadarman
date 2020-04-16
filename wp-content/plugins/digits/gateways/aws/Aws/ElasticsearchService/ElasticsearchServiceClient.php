<?php

namespace Aws\ElasticsearchService;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Elasticsearch Service** service.
 *
 * @method Result addTags( array $args = [] )
 * @method Promise addTagsAsync( array $args = [] )
 * @method Result cancelElasticsearchServiceSoftwareUpdate( array $args = [] )
 * @method Promise cancelElasticsearchServiceSoftwareUpdateAsync( array $args = [] )
 * @method Result createElasticsearchDomain( array $args = [] )
 * @method Promise createElasticsearchDomainAsync( array $args = [] )
 * @method Result deleteElasticsearchDomain( array $args = [] )
 * @method Promise deleteElasticsearchDomainAsync( array $args = [] )
 * @method Result deleteElasticsearchServiceRole( array $args = [] )
 * @method Promise deleteElasticsearchServiceRoleAsync( array $args = [] )
 * @method Result describeElasticsearchDomain( array $args = [] )
 * @method Promise describeElasticsearchDomainAsync( array $args = [] )
 * @method Result describeElasticsearchDomainConfig( array $args = [] )
 * @method Promise describeElasticsearchDomainConfigAsync( array $args = [] )
 * @method Result describeElasticsearchDomains( array $args = [] )
 * @method Promise describeElasticsearchDomainsAsync( array $args = [] )
 * @method Result describeElasticsearchInstanceTypeLimits( array $args = [] )
 * @method Promise describeElasticsearchInstanceTypeLimitsAsync( array $args = [] )
 * @method Result describeReservedElasticsearchInstanceOfferings( array $args = [] )
 * @method Promise describeReservedElasticsearchInstanceOfferingsAsync( array $args = [] )
 * @method Result describeReservedElasticsearchInstances( array $args = [] )
 * @method Promise describeReservedElasticsearchInstancesAsync( array $args = [] )
 * @method Result getCompatibleElasticsearchVersions( array $args = [] )
 * @method Promise getCompatibleElasticsearchVersionsAsync( array $args = [] )
 * @method Result getUpgradeHistory( array $args = [] )
 * @method Promise getUpgradeHistoryAsync( array $args = [] )
 * @method Result getUpgradeStatus( array $args = [] )
 * @method Promise getUpgradeStatusAsync( array $args = [] )
 * @method Result listDomainNames( array $args = [] )
 * @method Promise listDomainNamesAsync( array $args = [] )
 * @method Result listElasticsearchInstanceTypes( array $args = [] )
 * @method Promise listElasticsearchInstanceTypesAsync( array $args = [] )
 * @method Result listElasticsearchVersions( array $args = [] )
 * @method Promise listElasticsearchVersionsAsync( array $args = [] )
 * @method Result listTags( array $args = [] )
 * @method Promise listTagsAsync( array $args = [] )
 * @method Result purchaseReservedElasticsearchInstanceOffering( array $args = [] )
 * @method Promise purchaseReservedElasticsearchInstanceOfferingAsync( array $args = [] )
 * @method Result removeTags( array $args = [] )
 * @method Promise removeTagsAsync( array $args = [] )
 * @method Result startElasticsearchServiceSoftwareUpdate( array $args = [] )
 * @method Promise startElasticsearchServiceSoftwareUpdateAsync( array $args = [] )
 * @method Result updateElasticsearchDomainConfig( array $args = [] )
 * @method Promise updateElasticsearchDomainConfigAsync( array $args = [] )
 * @method Result upgradeElasticsearchDomain( array $args = [] )
 * @method Promise upgradeElasticsearchDomainAsync( array $args = [] )
 */
class ElasticsearchServiceClient extends AwsClient {
}
