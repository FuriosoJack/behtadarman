<?php

namespace Aws\Athena;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Athena** service.
 * @method Result batchGetNamedQuery( array $args = [] )
 * @method Promise batchGetNamedQueryAsync( array $args = [] )
 * @method Result batchGetQueryExecution( array $args = [] )
 * @method Promise batchGetQueryExecutionAsync( array $args = [] )
 * @method Result createNamedQuery( array $args = [] )
 * @method Promise createNamedQueryAsync( array $args = [] )
 * @method Result createWorkGroup( array $args = [] )
 * @method Promise createWorkGroupAsync( array $args = [] )
 * @method Result deleteNamedQuery( array $args = [] )
 * @method Promise deleteNamedQueryAsync( array $args = [] )
 * @method Result deleteWorkGroup( array $args = [] )
 * @method Promise deleteWorkGroupAsync( array $args = [] )
 * @method Result getNamedQuery( array $args = [] )
 * @method Promise getNamedQueryAsync( array $args = [] )
 * @method Result getQueryExecution( array $args = [] )
 * @method Promise getQueryExecutionAsync( array $args = [] )
 * @method Result getQueryResults( array $args = [] )
 * @method Promise getQueryResultsAsync( array $args = [] )
 * @method Result getWorkGroup( array $args = [] )
 * @method Promise getWorkGroupAsync( array $args = [] )
 * @method Result listNamedQueries( array $args = [] )
 * @method Promise listNamedQueriesAsync( array $args = [] )
 * @method Result listQueryExecutions( array $args = [] )
 * @method Promise listQueryExecutionsAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result listWorkGroups( array $args = [] )
 * @method Promise listWorkGroupsAsync( array $args = [] )
 * @method Result startQueryExecution( array $args = [] )
 * @method Promise startQueryExecutionAsync( array $args = [] )
 * @method Result stopQueryExecution( array $args = [] )
 * @method Promise stopQueryExecutionAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateWorkGroup( array $args = [] )
 * @method Promise updateWorkGroupAsync( array $args = [] )
 */
class AthenaClient extends AwsClient {
}
