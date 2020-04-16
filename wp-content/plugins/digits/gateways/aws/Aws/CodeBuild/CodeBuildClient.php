<?php

namespace Aws\CodeBuild;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS CodeBuild** service.
 * @method Result batchDeleteBuilds( array $args = [] )
 * @method Promise batchDeleteBuildsAsync( array $args = [] )
 * @method Result batchGetBuilds( array $args = [] )
 * @method Promise batchGetBuildsAsync( array $args = [] )
 * @method Result batchGetProjects( array $args = [] )
 * @method Promise batchGetProjectsAsync( array $args = [] )
 * @method Result createProject( array $args = [] )
 * @method Promise createProjectAsync( array $args = [] )
 * @method Result createWebhook( array $args = [] )
 * @method Promise createWebhookAsync( array $args = [] )
 * @method Result deleteProject( array $args = [] )
 * @method Promise deleteProjectAsync( array $args = [] )
 * @method Result deleteSourceCredentials( array $args = [] )
 * @method Promise deleteSourceCredentialsAsync( array $args = [] )
 * @method Result deleteWebhook( array $args = [] )
 * @method Promise deleteWebhookAsync( array $args = [] )
 * @method Result importSourceCredentials( array $args = [] )
 * @method Promise importSourceCredentialsAsync( array $args = [] )
 * @method Result invalidateProjectCache( array $args = [] )
 * @method Promise invalidateProjectCacheAsync( array $args = [] )
 * @method Result listBuilds( array $args = [] )
 * @method Promise listBuildsAsync( array $args = [] )
 * @method Result listBuildsForProject( array $args = [] )
 * @method Promise listBuildsForProjectAsync( array $args = [] )
 * @method Result listCuratedEnvironmentImages( array $args = [] )
 * @method Promise listCuratedEnvironmentImagesAsync( array $args = [] )
 * @method Result listProjects( array $args = [] )
 * @method Promise listProjectsAsync( array $args = [] )
 * @method Result listSourceCredentials( array $args = [] )
 * @method Promise listSourceCredentialsAsync( array $args = [] )
 * @method Result startBuild( array $args = [] )
 * @method Promise startBuildAsync( array $args = [] )
 * @method Result stopBuild( array $args = [] )
 * @method Promise stopBuildAsync( array $args = [] )
 * @method Result updateProject( array $args = [] )
 * @method Promise updateProjectAsync( array $args = [] )
 * @method Result updateWebhook( array $args = [] )
 * @method Promise updateWebhookAsync( array $args = [] )
 */
class CodeBuildClient extends AwsClient {
}
