<?php

namespace Aws\Kafka;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Managed Streaming for Kafka** service.
 * @method Result createCluster( array $args = [] )
 * @method Promise createClusterAsync( array $args = [] )
 * @method Result createConfiguration( array $args = [] )
 * @method Promise createConfigurationAsync( array $args = [] )
 * @method Result deleteCluster( array $args = [] )
 * @method Promise deleteClusterAsync( array $args = [] )
 * @method Result describeCluster( array $args = [] )
 * @method Promise describeClusterAsync( array $args = [] )
 * @method Result describeClusterOperation( array $args = [] )
 * @method Promise describeClusterOperationAsync( array $args = [] )
 * @method Result describeConfiguration( array $args = [] )
 * @method Promise describeConfigurationAsync( array $args = [] )
 * @method Result describeConfigurationRevision( array $args = [] )
 * @method Promise describeConfigurationRevisionAsync( array $args = [] )
 * @method Result getBootstrapBrokers( array $args = [] )
 * @method Promise getBootstrapBrokersAsync( array $args = [] )
 * @method Result listClusterOperations( array $args = [] )
 * @method Promise listClusterOperationsAsync( array $args = [] )
 * @method Result listClusters( array $args = [] )
 * @method Promise listClustersAsync( array $args = [] )
 * @method Result listConfigurationRevisions( array $args = [] )
 * @method Promise listConfigurationRevisionsAsync( array $args = [] )
 * @method Result listConfigurations( array $args = [] )
 * @method Promise listConfigurationsAsync( array $args = [] )
 * @method Result listNodes( array $args = [] )
 * @method Promise listNodesAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateBrokerStorage( array $args = [] )
 * @method Promise updateBrokerStorageAsync( array $args = [] )
 * @method Result updateClusterConfiguration( array $args = [] )
 * @method Promise updateClusterConfigurationAsync( array $args = [] )
 */
class KafkaClient extends AwsClient {
}
