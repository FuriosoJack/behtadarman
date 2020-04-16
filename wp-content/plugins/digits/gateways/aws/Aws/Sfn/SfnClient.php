<?php

namespace Aws\Sfn;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Step Functions** service.
 * @method Result createActivity( array $args = [] )
 * @method Promise createActivityAsync( array $args = [] )
 * @method Result createStateMachine( array $args = [] )
 * @method Promise createStateMachineAsync( array $args = [] )
 * @method Result deleteActivity( array $args = [] )
 * @method Promise deleteActivityAsync( array $args = [] )
 * @method Result deleteStateMachine( array $args = [] )
 * @method Promise deleteStateMachineAsync( array $args = [] )
 * @method Result describeActivity( array $args = [] )
 * @method Promise describeActivityAsync( array $args = [] )
 * @method Result describeExecution( array $args = [] )
 * @method Promise describeExecutionAsync( array $args = [] )
 * @method Result describeStateMachine( array $args = [] )
 * @method Promise describeStateMachineAsync( array $args = [] )
 * @method Result describeStateMachineForExecution( array $args = [] )
 * @method Promise describeStateMachineForExecutionAsync( array $args = [] )
 * @method Result getActivityTask( array $args = [] )
 * @method Promise getActivityTaskAsync( array $args = [] )
 * @method Result getExecutionHistory( array $args = [] )
 * @method Promise getExecutionHistoryAsync( array $args = [] )
 * @method Result listActivities( array $args = [] )
 * @method Promise listActivitiesAsync( array $args = [] )
 * @method Result listExecutions( array $args = [] )
 * @method Promise listExecutionsAsync( array $args = [] )
 * @method Result listStateMachines( array $args = [] )
 * @method Promise listStateMachinesAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result sendTaskFailure( array $args = [] )
 * @method Promise sendTaskFailureAsync( array $args = [] )
 * @method Result sendTaskHeartbeat( array $args = [] )
 * @method Promise sendTaskHeartbeatAsync( array $args = [] )
 * @method Result sendTaskSuccess( array $args = [] )
 * @method Promise sendTaskSuccessAsync( array $args = [] )
 * @method Result startExecution( array $args = [] )
 * @method Promise startExecutionAsync( array $args = [] )
 * @method Result stopExecution( array $args = [] )
 * @method Promise stopExecutionAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateStateMachine( array $args = [] )
 * @method Promise updateStateMachineAsync( array $args = [] )
 */
class SfnClient extends AwsClient {
}
