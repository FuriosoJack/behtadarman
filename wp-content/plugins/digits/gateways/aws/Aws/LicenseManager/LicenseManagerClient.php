<?php

namespace Aws\LicenseManager;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS License Manager** service.
 * @method Result createLicenseConfiguration( array $args = [] )
 * @method Promise createLicenseConfigurationAsync( array $args = [] )
 * @method Result deleteLicenseConfiguration( array $args = [] )
 * @method Promise deleteLicenseConfigurationAsync( array $args = [] )
 * @method Result getLicenseConfiguration( array $args = [] )
 * @method Promise getLicenseConfigurationAsync( array $args = [] )
 * @method Result getServiceSettings( array $args = [] )
 * @method Promise getServiceSettingsAsync( array $args = [] )
 * @method Result listAssociationsForLicenseConfiguration( array $args = [] )
 * @method Promise listAssociationsForLicenseConfigurationAsync( array $args = [] )
 * @method Result listLicenseConfigurations( array $args = [] )
 * @method Promise listLicenseConfigurationsAsync( array $args = [] )
 * @method Result listLicenseSpecificationsForResource( array $args = [] )
 * @method Promise listLicenseSpecificationsForResourceAsync( array $args = [] )
 * @method Result listResourceInventory( array $args = [] )
 * @method Promise listResourceInventoryAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result listUsageForLicenseConfiguration( array $args = [] )
 * @method Promise listUsageForLicenseConfigurationAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateLicenseConfiguration( array $args = [] )
 * @method Promise updateLicenseConfigurationAsync( array $args = [] )
 * @method Result updateLicenseSpecificationsForResource( array $args = [] )
 * @method Promise updateLicenseSpecificationsForResourceAsync( array $args = [] )
 * @method Result updateServiceSettings( array $args = [] )
 * @method Promise updateServiceSettingsAsync( array $args = [] )
 */
class LicenseManagerClient extends AwsClient {
}
