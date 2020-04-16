<?php

namespace Aws\CloudTrail;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS CloudTrail** service.
 *
 * @method Result addTags( array $args = [] )
 * @method Promise addTagsAsync( array $args = [] )
 * @method Result createTrail( array $args = [] )
 * @method Promise createTrailAsync( array $args = [] )
 * @method Result deleteTrail( array $args = [] )
 * @method Promise deleteTrailAsync( array $args = [] )
 * @method Result describeTrails( array $args = [] )
 * @method Promise describeTrailsAsync( array $args = [] )
 * @method Result getEventSelectors( array $args = [] )
 * @method Promise getEventSelectorsAsync( array $args = [] )
 * @method Result getTrailStatus( array $args = [] )
 * @method Promise getTrailStatusAsync( array $args = [] )
 * @method Result listPublicKeys( array $args = [] )
 * @method Promise listPublicKeysAsync( array $args = [] )
 * @method Result listTags( array $args = [] )
 * @method Promise listTagsAsync( array $args = [] )
 * @method Result lookupEvents( array $args = [] )
 * @method Promise lookupEventsAsync( array $args = [] )
 * @method Result putEventSelectors( array $args = [] )
 * @method Promise putEventSelectorsAsync( array $args = [] )
 * @method Result removeTags( array $args = [] )
 * @method Promise removeTagsAsync( array $args = [] )
 * @method Result startLogging( array $args = [] )
 * @method Promise startLoggingAsync( array $args = [] )
 * @method Result stopLogging( array $args = [] )
 * @method Promise stopLoggingAsync( array $args = [] )
 * @method Result updateTrail( array $args = [] )
 * @method Promise updateTrailAsync( array $args = [] )
 */
class CloudTrailClient extends AwsClient {
}
