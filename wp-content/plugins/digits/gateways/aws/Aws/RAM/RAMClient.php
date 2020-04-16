<?php

namespace Aws\RAM;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Resource Access Manager** service.
 * @method Result acceptResourceShareInvitation( array $args = [] )
 * @method Promise acceptResourceShareInvitationAsync( array $args = [] )
 * @method Result associateResourceShare( array $args = [] )
 * @method Promise associateResourceShareAsync( array $args = [] )
 * @method Result createResourceShare( array $args = [] )
 * @method Promise createResourceShareAsync( array $args = [] )
 * @method Result deleteResourceShare( array $args = [] )
 * @method Promise deleteResourceShareAsync( array $args = [] )
 * @method Result disassociateResourceShare( array $args = [] )
 * @method Promise disassociateResourceShareAsync( array $args = [] )
 * @method Result enableSharingWithAwsOrganization( array $args = [] )
 * @method Promise enableSharingWithAwsOrganizationAsync( array $args = [] )
 * @method Result getResourcePolicies( array $args = [] )
 * @method Promise getResourcePoliciesAsync( array $args = [] )
 * @method Result getResourceShareAssociations( array $args = [] )
 * @method Promise getResourceShareAssociationsAsync( array $args = [] )
 * @method Result getResourceShareInvitations( array $args = [] )
 * @method Promise getResourceShareInvitationsAsync( array $args = [] )
 * @method Result getResourceShares( array $args = [] )
 * @method Promise getResourceSharesAsync( array $args = [] )
 * @method Result listPrincipals( array $args = [] )
 * @method Promise listPrincipalsAsync( array $args = [] )
 * @method Result listResources( array $args = [] )
 * @method Promise listResourcesAsync( array $args = [] )
 * @method Result rejectResourceShareInvitation( array $args = [] )
 * @method Promise rejectResourceShareInvitationAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateResourceShare( array $args = [] )
 * @method Promise updateResourceShareAsync( array $args = [] )
 */
class RAMClient extends AwsClient {
}
