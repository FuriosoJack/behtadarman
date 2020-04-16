<?php

namespace Aws\DataSync;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS DataSync** service.
 * @method Result cancelTaskExecution( array $args = [] )
 * @method Promise cancelTaskExecutionAsync( array $args = [] )
 * @method Result createAgent( array $args = [] )
 * @method Promise createAgentAsync( array $args = [] )
 * @method Result createLocationEfs( array $args = [] )
 * @method Promise createLocationEfsAsync( array $args = [] )
 * @method Result createLocationNfs( array $args = [] )
 * @method Promise createLocationNfsAsync( array $args = [] )
 * @method Result createLocationS3( array $args = [] )
 * @method Promise createLocationS3Async( array $args = [] )
 * @method Result createTask( array $args = [] )
 * @method Promise createTaskAsync( array $args = [] )
 * @method Result deleteAgent( array $args = [] )
 * @method Promise deleteAgentAsync( array $args = [] )
 * @method Result deleteLocation( array $args = [] )
 * @method Promise deleteLocationAsync( array $args = [] )
 * @method Result deleteTask( array $args = [] )
 * @method Promise deleteTaskAsync( array $args = [] )
 * @method Result describeAgent( array $args = [] )
 * @method Promise describeAgentAsync( array $args = [] )
 * @method Result describeLocationEfs( array $args = [] )
 * @method Promise describeLocationEfsAsync( array $args = [] )
 * @method Result describeLocationNfs( array $args = [] )
 * @method Promise describeLocationNfsAsync( array $args = [] )
 * @method Result describeLocationS3( array $args = [] )
 * @method Promise describeLocationS3Async( array $args = [] )
 * @method Result describeTask( array $args = [] )
 * @method Promise describeTaskAsync( array $args = [] )
 * @method Result describeTaskExecution( array $args = [] )
 * @method Promise describeTaskExecutionAsync( array $args = [] )
 * @method Result listAgents( array $args = [] )
 * @method Promise listAgentsAsync( array $args = [] )
 * @method Result listLocations( array $args = [] )
 * @method Promise listLocationsAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result listTaskExecutions( array $args = [] )
 * @method Promise listTaskExecutionsAsync( array $args = [] )
 * @method Result listTasks( array $args = [] )
 * @method Promise listTasksAsync( array $args = [] )
 * @method Result startTaskExecution( array $args = [] )
 * @method Promise startTaskExecutionAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateAgent( array $args = [] )
 * @method Promise updateAgentAsync( array $args = [] )
 * @method Result updateTask( array $args = [] )
 * @method Promise updateTaskAsync( array $args = [] )
 */
class DataSyncClient extends AwsClient {
}
