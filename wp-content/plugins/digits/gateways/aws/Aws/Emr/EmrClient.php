<?php

namespace Aws\Emr;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Elastic MapReduce (Amazon EMR)** service.
 *
 * @method Result addInstanceFleet( array $args = [] )
 * @method Promise addInstanceFleetAsync( array $args = [] )
 * @method Result addInstanceGroups( array $args = [] )
 * @method Promise addInstanceGroupsAsync( array $args = [] )
 * @method Result addJobFlowSteps( array $args = [] )
 * @method Promise addJobFlowStepsAsync( array $args = [] )
 * @method Result addTags( array $args = [] )
 * @method Promise addTagsAsync( array $args = [] )
 * @method Result cancelSteps( array $args = [] )
 * @method Promise cancelStepsAsync( array $args = [] )
 * @method Result createSecurityConfiguration( array $args = [] )
 * @method Promise createSecurityConfigurationAsync( array $args = [] )
 * @method Result deleteSecurityConfiguration( array $args = [] )
 * @method Promise deleteSecurityConfigurationAsync( array $args = [] )
 * @method Result describeCluster( array $args = [] )
 * @method Promise describeClusterAsync( array $args = [] )
 * @method Result describeJobFlows( array $args = [] )
 * @method Promise describeJobFlowsAsync( array $args = [] )
 * @method Result describeSecurityConfiguration( array $args = [] )
 * @method Promise describeSecurityConfigurationAsync( array $args = [] )
 * @method Result describeStep( array $args = [] )
 * @method Promise describeStepAsync( array $args = [] )
 * @method Result listBootstrapActions( array $args = [] )
 * @method Promise listBootstrapActionsAsync( array $args = [] )
 * @method Result listClusters( array $args = [] )
 * @method Promise listClustersAsync( array $args = [] )
 * @method Result listInstanceFleets( array $args = [] )
 * @method Promise listInstanceFleetsAsync( array $args = [] )
 * @method Result listInstanceGroups( array $args = [] )
 * @method Promise listInstanceGroupsAsync( array $args = [] )
 * @method Result listInstances( array $args = [] )
 * @method Promise listInstancesAsync( array $args = [] )
 * @method Result listSecurityConfigurations( array $args = [] )
 * @method Promise listSecurityConfigurationsAsync( array $args = [] )
 * @method Result listSteps( array $args = [] )
 * @method Promise listStepsAsync( array $args = [] )
 * @method Result modifyInstanceFleet( array $args = [] )
 * @method Promise modifyInstanceFleetAsync( array $args = [] )
 * @method Result modifyInstanceGroups( array $args = [] )
 * @method Promise modifyInstanceGroupsAsync( array $args = [] )
 * @method Result putAutoScalingPolicy( array $args = [] )
 * @method Promise putAutoScalingPolicyAsync( array $args = [] )
 * @method Result removeAutoScalingPolicy( array $args = [] )
 * @method Promise removeAutoScalingPolicyAsync( array $args = [] )
 * @method Result removeTags( array $args = [] )
 * @method Promise removeTagsAsync( array $args = [] )
 * @method Result runJobFlow( array $args = [] )
 * @method Promise runJobFlowAsync( array $args = [] )
 * @method Result setTerminationProtection( array $args = [] )
 * @method Promise setTerminationProtectionAsync( array $args = [] )
 * @method Result setVisibleToAllUsers( array $args = [] )
 * @method Promise setVisibleToAllUsersAsync( array $args = [] )
 * @method Result terminateJobFlows( array $args = [] )
 * @method Promise terminateJobFlowsAsync( array $args = [] )
 */
class EmrClient extends AwsClient {
}
