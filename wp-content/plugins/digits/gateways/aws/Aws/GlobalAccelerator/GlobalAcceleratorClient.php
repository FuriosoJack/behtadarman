<?php

namespace Aws\GlobalAccelerator;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Global Accelerator** service.
 * @method Result createAccelerator( array $args = [] )
 * @method Promise createAcceleratorAsync( array $args = [] )
 * @method Result createEndpointGroup( array $args = [] )
 * @method Promise createEndpointGroupAsync( array $args = [] )
 * @method Result createListener( array $args = [] )
 * @method Promise createListenerAsync( array $args = [] )
 * @method Result deleteAccelerator( array $args = [] )
 * @method Promise deleteAcceleratorAsync( array $args = [] )
 * @method Result deleteEndpointGroup( array $args = [] )
 * @method Promise deleteEndpointGroupAsync( array $args = [] )
 * @method Result deleteListener( array $args = [] )
 * @method Promise deleteListenerAsync( array $args = [] )
 * @method Result describeAccelerator( array $args = [] )
 * @method Promise describeAcceleratorAsync( array $args = [] )
 * @method Result describeAcceleratorAttributes( array $args = [] )
 * @method Promise describeAcceleratorAttributesAsync( array $args = [] )
 * @method Result describeEndpointGroup( array $args = [] )
 * @method Promise describeEndpointGroupAsync( array $args = [] )
 * @method Result describeListener( array $args = [] )
 * @method Promise describeListenerAsync( array $args = [] )
 * @method Result listAccelerators( array $args = [] )
 * @method Promise listAcceleratorsAsync( array $args = [] )
 * @method Result listEndpointGroups( array $args = [] )
 * @method Promise listEndpointGroupsAsync( array $args = [] )
 * @method Result listListeners( array $args = [] )
 * @method Promise listListenersAsync( array $args = [] )
 * @method Result updateAccelerator( array $args = [] )
 * @method Promise updateAcceleratorAsync( array $args = [] )
 * @method Result updateAcceleratorAttributes( array $args = [] )
 * @method Promise updateAcceleratorAttributesAsync( array $args = [] )
 * @method Result updateEndpointGroup( array $args = [] )
 * @method Promise updateEndpointGroupAsync( array $args = [] )
 * @method Result updateListener( array $args = [] )
 * @method Promise updateListenerAsync( array $args = [] )
 */
class GlobalAcceleratorClient extends AwsClient {
}
