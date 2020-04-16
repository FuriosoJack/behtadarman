<?php

namespace Aws\ServiceDiscovery;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Route 53 Auto Naming** service.
 * @method Result createHttpNamespace( array $args = [] )
 * @method Promise createHttpNamespaceAsync( array $args = [] )
 * @method Result createPrivateDnsNamespace( array $args = [] )
 * @method Promise createPrivateDnsNamespaceAsync( array $args = [] )
 * @method Result createPublicDnsNamespace( array $args = [] )
 * @method Promise createPublicDnsNamespaceAsync( array $args = [] )
 * @method Result createService( array $args = [] )
 * @method Promise createServiceAsync( array $args = [] )
 * @method Result deleteNamespace( array $args = [] )
 * @method Promise deleteNamespaceAsync( array $args = [] )
 * @method Result deleteService( array $args = [] )
 * @method Promise deleteServiceAsync( array $args = [] )
 * @method Result deregisterInstance( array $args = [] )
 * @method Promise deregisterInstanceAsync( array $args = [] )
 * @method Result discoverInstances( array $args = [] )
 * @method Promise discoverInstancesAsync( array $args = [] )
 * @method Result getInstance( array $args = [] )
 * @method Promise getInstanceAsync( array $args = [] )
 * @method Result getInstancesHealthStatus( array $args = [] )
 * @method Promise getInstancesHealthStatusAsync( array $args = [] )
 * @method Result getNamespace( array $args = [] )
 * @method Promise getNamespaceAsync( array $args = [] )
 * @method Result getOperation( array $args = [] )
 * @method Promise getOperationAsync( array $args = [] )
 * @method Result getService( array $args = [] )
 * @method Promise getServiceAsync( array $args = [] )
 * @method Result listInstances( array $args = [] )
 * @method Promise listInstancesAsync( array $args = [] )
 * @method Result listNamespaces( array $args = [] )
 * @method Promise listNamespacesAsync( array $args = [] )
 * @method Result listOperations( array $args = [] )
 * @method Promise listOperationsAsync( array $args = [] )
 * @method Result listServices( array $args = [] )
 * @method Promise listServicesAsync( array $args = [] )
 * @method Result registerInstance( array $args = [] )
 * @method Promise registerInstanceAsync( array $args = [] )
 * @method Result updateInstanceCustomHealthStatus( array $args = [] )
 * @method Promise updateInstanceCustomHealthStatusAsync( array $args = [] )
 * @method Result updateService( array $args = [] )
 * @method Promise updateServiceAsync( array $args = [] )
 */
class ServiceDiscoveryClient extends AwsClient {
}
