<?php

namespace Aws\MediaConnect;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS MediaConnect** service.
 * @method Result addFlowOutputs( array $args = [] )
 * @method Promise addFlowOutputsAsync( array $args = [] )
 * @method Result createFlow( array $args = [] )
 * @method Promise createFlowAsync( array $args = [] )
 * @method Result deleteFlow( array $args = [] )
 * @method Promise deleteFlowAsync( array $args = [] )
 * @method Result describeFlow( array $args = [] )
 * @method Promise describeFlowAsync( array $args = [] )
 * @method Result grantFlowEntitlements( array $args = [] )
 * @method Promise grantFlowEntitlementsAsync( array $args = [] )
 * @method Result listEntitlements( array $args = [] )
 * @method Promise listEntitlementsAsync( array $args = [] )
 * @method Result listFlows( array $args = [] )
 * @method Promise listFlowsAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result removeFlowOutput( array $args = [] )
 * @method Promise removeFlowOutputAsync( array $args = [] )
 * @method Result revokeFlowEntitlement( array $args = [] )
 * @method Promise revokeFlowEntitlementAsync( array $args = [] )
 * @method Result startFlow( array $args = [] )
 * @method Promise startFlowAsync( array $args = [] )
 * @method Result stopFlow( array $args = [] )
 * @method Promise stopFlowAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateFlowEntitlement( array $args = [] )
 * @method Promise updateFlowEntitlementAsync( array $args = [] )
 * @method Result updateFlowOutput( array $args = [] )
 * @method Promise updateFlowOutputAsync( array $args = [] )
 * @method Result updateFlowSource( array $args = [] )
 * @method Promise updateFlowSourceAsync( array $args = [] )
 */
class MediaConnectClient extends AwsClient {
}
