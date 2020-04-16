<?php

namespace Aws\Connect;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Connect Service** service.
 * @method Result createUser( array $args = [] )
 * @method Promise createUserAsync( array $args = [] )
 * @method Result deleteUser( array $args = [] )
 * @method Promise deleteUserAsync( array $args = [] )
 * @method Result describeUser( array $args = [] )
 * @method Promise describeUserAsync( array $args = [] )
 * @method Result describeUserHierarchyGroup( array $args = [] )
 * @method Promise describeUserHierarchyGroupAsync( array $args = [] )
 * @method Result describeUserHierarchyStructure( array $args = [] )
 * @method Promise describeUserHierarchyStructureAsync( array $args = [] )
 * @method Result getContactAttributes( array $args = [] )
 * @method Promise getContactAttributesAsync( array $args = [] )
 * @method Result getCurrentMetricData( array $args = [] )
 * @method Promise getCurrentMetricDataAsync( array $args = [] )
 * @method Result getFederationToken( array $args = [] )
 * @method Promise getFederationTokenAsync( array $args = [] )
 * @method Result getMetricData( array $args = [] )
 * @method Promise getMetricDataAsync( array $args = [] )
 * @method Result listRoutingProfiles( array $args = [] )
 * @method Promise listRoutingProfilesAsync( array $args = [] )
 * @method Result listSecurityProfiles( array $args = [] )
 * @method Promise listSecurityProfilesAsync( array $args = [] )
 * @method Result listUserHierarchyGroups( array $args = [] )
 * @method Promise listUserHierarchyGroupsAsync( array $args = [] )
 * @method Result listUsers( array $args = [] )
 * @method Promise listUsersAsync( array $args = [] )
 * @method Result startOutboundVoiceContact( array $args = [] )
 * @method Promise startOutboundVoiceContactAsync( array $args = [] )
 * @method Result stopContact( array $args = [] )
 * @method Promise stopContactAsync( array $args = [] )
 * @method Result updateContactAttributes( array $args = [] )
 * @method Promise updateContactAttributesAsync( array $args = [] )
 * @method Result updateUserHierarchy( array $args = [] )
 * @method Promise updateUserHierarchyAsync( array $args = [] )
 * @method Result updateUserIdentityInfo( array $args = [] )
 * @method Promise updateUserIdentityInfoAsync( array $args = [] )
 * @method Result updateUserPhoneConfig( array $args = [] )
 * @method Promise updateUserPhoneConfigAsync( array $args = [] )
 * @method Result updateUserRoutingProfile( array $args = [] )
 * @method Promise updateUserRoutingProfileAsync( array $args = [] )
 * @method Result updateUserSecurityProfiles( array $args = [] )
 * @method Promise updateUserSecurityProfilesAsync( array $args = [] )
 */
class ConnectClient extends AwsClient {
}
