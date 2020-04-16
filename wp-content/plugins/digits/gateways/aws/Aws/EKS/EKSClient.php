<?php

namespace Aws\EKS;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Elastic Container Service for Kubernetes** service.
 * @method Result createCluster( array $args = [] )
 * @method Promise createClusterAsync( array $args = [] )
 * @method Result deleteCluster( array $args = [] )
 * @method Promise deleteClusterAsync( array $args = [] )
 * @method Result describeCluster( array $args = [] )
 * @method Promise describeClusterAsync( array $args = [] )
 * @method Result describeUpdate( array $args = [] )
 * @method Promise describeUpdateAsync( array $args = [] )
 * @method Result listClusters( array $args = [] )
 * @method Promise listClustersAsync( array $args = [] )
 * @method Result listUpdates( array $args = [] )
 * @method Promise listUpdatesAsync( array $args = [] )
 * @method Result updateClusterConfig( array $args = [] )
 * @method Promise updateClusterConfigAsync( array $args = [] )
 * @method Result updateClusterVersion( array $args = [] )
 * @method Promise updateClusterVersionAsync( array $args = [] )
 */
class EKSClient extends AwsClient {
}
