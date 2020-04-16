<?php

namespace Aws\KinesisVideo;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Kinesis Video Streams** service.
 * @method Result createStream( array $args = [] )
 * @method Promise createStreamAsync( array $args = [] )
 * @method Result deleteStream( array $args = [] )
 * @method Promise deleteStreamAsync( array $args = [] )
 * @method Result describeStream( array $args = [] )
 * @method Promise describeStreamAsync( array $args = [] )
 * @method Result getDataEndpoint( array $args = [] )
 * @method Promise getDataEndpointAsync( array $args = [] )
 * @method Result listStreams( array $args = [] )
 * @method Promise listStreamsAsync( array $args = [] )
 * @method Result listTagsForStream( array $args = [] )
 * @method Promise listTagsForStreamAsync( array $args = [] )
 * @method Result tagStream( array $args = [] )
 * @method Promise tagStreamAsync( array $args = [] )
 * @method Result untagStream( array $args = [] )
 * @method Promise untagStreamAsync( array $args = [] )
 * @method Result updateDataRetention( array $args = [] )
 * @method Promise updateDataRetentionAsync( array $args = [] )
 * @method Result updateStream( array $args = [] )
 * @method Promise updateStreamAsync( array $args = [] )
 */
class KinesisVideoClient extends AwsClient {
}
