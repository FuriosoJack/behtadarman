<?php

namespace Aws\QuickSight;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon QuickSight** service.
 * @method Result createGroup( array $args = [] )
 * @method Promise createGroupAsync( array $args = [] )
 * @method Result createGroupMembership( array $args = [] )
 * @method Promise createGroupMembershipAsync( array $args = [] )
 * @method Result deleteGroup( array $args = [] )
 * @method Promise deleteGroupAsync( array $args = [] )
 * @method Result deleteGroupMembership( array $args = [] )
 * @method Promise deleteGroupMembershipAsync( array $args = [] )
 * @method Result deleteUser( array $args = [] )
 * @method Promise deleteUserAsync( array $args = [] )
 * @method Result deleteUserByPrincipalId( array $args = [] )
 * @method Promise deleteUserByPrincipalIdAsync( array $args = [] )
 * @method Result describeGroup( array $args = [] )
 * @method Promise describeGroupAsync( array $args = [] )
 * @method Result describeUser( array $args = [] )
 * @method Promise describeUserAsync( array $args = [] )
 * @method Result getDashboardEmbedUrl( array $args = [] )
 * @method Promise getDashboardEmbedUrlAsync( array $args = [] )
 * @method Result listGroupMemberships( array $args = [] )
 * @method Promise listGroupMembershipsAsync( array $args = [] )
 * @method Result listGroups( array $args = [] )
 * @method Promise listGroupsAsync( array $args = [] )
 * @method Result listUserGroups( array $args = [] )
 * @method Promise listUserGroupsAsync( array $args = [] )
 * @method Result listUsers( array $args = [] )
 * @method Promise listUsersAsync( array $args = [] )
 * @method Result registerUser( array $args = [] )
 * @method Promise registerUserAsync( array $args = [] )
 * @method Result updateGroup( array $args = [] )
 * @method Promise updateGroupAsync( array $args = [] )
 * @method Result updateUser( array $args = [] )
 * @method Promise updateUserAsync( array $args = [] )
 */
class QuickSightClient extends AwsClient {
}
