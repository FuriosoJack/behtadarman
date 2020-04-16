<?php

namespace Aws\CostExplorer;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Cost Explorer Service** service.
 * @method Result getCostAndUsage( array $args = [] )
 * @method Promise getCostAndUsageAsync( array $args = [] )
 * @method Result getCostForecast( array $args = [] )
 * @method Promise getCostForecastAsync( array $args = [] )
 * @method Result getDimensionValues( array $args = [] )
 * @method Promise getDimensionValuesAsync( array $args = [] )
 * @method Result getReservationCoverage( array $args = [] )
 * @method Promise getReservationCoverageAsync( array $args = [] )
 * @method Result getReservationPurchaseRecommendation( array $args = [] )
 * @method Promise getReservationPurchaseRecommendationAsync( array $args = [] )
 * @method Result getReservationUtilization( array $args = [] )
 * @method Promise getReservationUtilizationAsync( array $args = [] )
 * @method Result getTags( array $args = [] )
 * @method Promise getTagsAsync( array $args = [] )
 * @method Result getUsageForecast( array $args = [] )
 * @method Promise getUsageForecastAsync( array $args = [] )
 */
class CostExplorerClient extends AwsClient {
}
