<?php

namespace Aws\Amplify;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Amplify** service.
 * @method Result createApp( array $args = [] )
 * @method Promise createAppAsync( array $args = [] )
 * @method Result createBranch( array $args = [] )
 * @method Promise createBranchAsync( array $args = [] )
 * @method Result createDeployment( array $args = [] )
 * @method Promise createDeploymentAsync( array $args = [] )
 * @method Result createDomainAssociation( array $args = [] )
 * @method Promise createDomainAssociationAsync( array $args = [] )
 * @method Result createWebhook( array $args = [] )
 * @method Promise createWebhookAsync( array $args = [] )
 * @method Result deleteApp( array $args = [] )
 * @method Promise deleteAppAsync( array $args = [] )
 * @method Result deleteBranch( array $args = [] )
 * @method Promise deleteBranchAsync( array $args = [] )
 * @method Result deleteDomainAssociation( array $args = [] )
 * @method Promise deleteDomainAssociationAsync( array $args = [] )
 * @method Result deleteJob( array $args = [] )
 * @method Promise deleteJobAsync( array $args = [] )
 * @method Result deleteWebhook( array $args = [] )
 * @method Promise deleteWebhookAsync( array $args = [] )
 * @method Result getApp( array $args = [] )
 * @method Promise getAppAsync( array $args = [] )
 * @method Result getBranch( array $args = [] )
 * @method Promise getBranchAsync( array $args = [] )
 * @method Result getDomainAssociation( array $args = [] )
 * @method Promise getDomainAssociationAsync( array $args = [] )
 * @method Result getJob( array $args = [] )
 * @method Promise getJobAsync( array $args = [] )
 * @method Result getWebhook( array $args = [] )
 * @method Promise getWebhookAsync( array $args = [] )
 * @method Result listApps( array $args = [] )
 * @method Promise listAppsAsync( array $args = [] )
 * @method Result listBranches( array $args = [] )
 * @method Promise listBranchesAsync( array $args = [] )
 * @method Result listDomainAssociations( array $args = [] )
 * @method Promise listDomainAssociationsAsync( array $args = [] )
 * @method Result listJobs( array $args = [] )
 * @method Promise listJobsAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result listWebhooks( array $args = [] )
 * @method Promise listWebhooksAsync( array $args = [] )
 * @method Result startDeployment( array $args = [] )
 * @method Promise startDeploymentAsync( array $args = [] )
 * @method Result startJob( array $args = [] )
 * @method Promise startJobAsync( array $args = [] )
 * @method Result stopJob( array $args = [] )
 * @method Promise stopJobAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateApp( array $args = [] )
 * @method Promise updateAppAsync( array $args = [] )
 * @method Result updateBranch( array $args = [] )
 * @method Promise updateBranchAsync( array $args = [] )
 * @method Result updateDomainAssociation( array $args = [] )
 * @method Promise updateDomainAssociationAsync( array $args = [] )
 * @method Result updateWebhook( array $args = [] )
 * @method Promise updateWebhookAsync( array $args = [] )
 */
class AmplifyClient extends AwsClient {
}