<?php

namespace Aws\Health;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Health APIs and Notifications** service.
 * @method Result describeAffectedEntities( array $args = [] )
 * @method Promise describeAffectedEntitiesAsync( array $args = [] )
 * @method Result describeEntityAggregates( array $args = [] )
 * @method Promise describeEntityAggregatesAsync( array $args = [] )
 * @method Result describeEventAggregates( array $args = [] )
 * @method Promise describeEventAggregatesAsync( array $args = [] )
 * @method Result describeEventDetails( array $args = [] )
 * @method Promise describeEventDetailsAsync( array $args = [] )
 * @method Result describeEventTypes( array $args = [] )
 * @method Promise describeEventTypesAsync( array $args = [] )
 * @method Result describeEvents( array $args = [] )
 * @method Promise describeEventsAsync( array $args = [] )
 */
class HealthClient extends AwsClient {
}
