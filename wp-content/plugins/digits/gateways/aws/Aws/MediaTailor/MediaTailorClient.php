<?php

namespace Aws\MediaTailor;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS MediaTailor** service.
 * @method Result deletePlaybackConfiguration( array $args = [] )
 * @method Promise deletePlaybackConfigurationAsync( array $args = [] )
 * @method Result getPlaybackConfiguration( array $args = [] )
 * @method Promise getPlaybackConfigurationAsync( array $args = [] )
 * @method Result listPlaybackConfigurations( array $args = [] )
 * @method Promise listPlaybackConfigurationsAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result putPlaybackConfiguration( array $args = [] )
 * @method Promise putPlaybackConfigurationAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 */
class MediaTailorClient extends AwsClient {
}
