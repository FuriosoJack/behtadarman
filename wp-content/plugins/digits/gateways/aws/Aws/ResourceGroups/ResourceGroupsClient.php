<?php

namespace Aws\ResourceGroups;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Resource Groups** service.
 * @method Result createGroup( array $args = [] )
 * @method Promise createGroupAsync( array $args = [] )
 * @method Result deleteGroup( array $args = [] )
 * @method Promise deleteGroupAsync( array $args = [] )
 * @method Result getGroup( array $args = [] )
 * @method Promise getGroupAsync( array $args = [] )
 * @method Result getGroupQuery( array $args = [] )
 * @method Promise getGroupQueryAsync( array $args = [] )
 * @method Result getTags( array $args = [] )
 * @method Promise getTagsAsync( array $args = [] )
 * @method Result listGroupResources( array $args = [] )
 * @method Promise listGroupResourcesAsync( array $args = [] )
 * @method Result listGroups( array $args = [] )
 * @method Promise listGroupsAsync( array $args = [] )
 * @method Result searchResources( array $args = [] )
 * @method Promise searchResourcesAsync( array $args = [] )
 * @method Result tag( array $args = [] )
 * @method Promise tagAsync( array $args = [] )
 * @method Result untag( array $args = [] )
 * @method Promise untagAsync( array $args = [] )
 * @method Result updateGroup( array $args = [] )
 * @method Promise updateGroupAsync( array $args = [] )
 * @method Result updateGroupQuery( array $args = [] )
 * @method Promise updateGroupQueryAsync( array $args = [] )
 */
class ResourceGroupsClient extends AwsClient {
}
