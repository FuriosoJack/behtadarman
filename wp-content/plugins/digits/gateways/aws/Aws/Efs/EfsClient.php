<?php

namespace Aws\Efs;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with **Amazon EFS**.
 *
 * @method Result createFileSystem( array $args = [] )
 * @method Promise createFileSystemAsync( array $args = [] )
 * @method Result createMountTarget( array $args = [] )
 * @method Promise createMountTargetAsync( array $args = [] )
 * @method Result createTags( array $args = [] )
 * @method Promise createTagsAsync( array $args = [] )
 * @method Result deleteFileSystem( array $args = [] )
 * @method Promise deleteFileSystemAsync( array $args = [] )
 * @method Result deleteMountTarget( array $args = [] )
 * @method Promise deleteMountTargetAsync( array $args = [] )
 * @method Result deleteTags( array $args = [] )
 * @method Promise deleteTagsAsync( array $args = [] )
 * @method Result describeFileSystems( array $args = [] )
 * @method Promise describeFileSystemsAsync( array $args = [] )
 * @method Result describeLifecycleConfiguration( array $args = [] )
 * @method Promise describeLifecycleConfigurationAsync( array $args = [] )
 * @method Result describeMountTargetSecurityGroups( array $args = [] )
 * @method Promise describeMountTargetSecurityGroupsAsync( array $args = [] )
 * @method Result describeMountTargets( array $args = [] )
 * @method Promise describeMountTargetsAsync( array $args = [] )
 * @method Result describeTags( array $args = [] )
 * @method Promise describeTagsAsync( array $args = [] )
 * @method Result modifyMountTargetSecurityGroups( array $args = [] )
 * @method Promise modifyMountTargetSecurityGroupsAsync( array $args = [] )
 * @method Result putLifecycleConfiguration( array $args = [] )
 * @method Promise putLifecycleConfigurationAsync( array $args = [] )
 * @method Result updateFileSystem( array $args = [] )
 * @method Promise updateFileSystemAsync( array $args = [] )
 */
class EfsClient extends AwsClient {
}
