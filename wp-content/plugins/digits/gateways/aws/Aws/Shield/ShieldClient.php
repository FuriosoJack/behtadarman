<?php

namespace Aws\Shield;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Shield** service.
 * @method Result associateDRTLogBucket( array $args = [] )
 * @method Promise associateDRTLogBucketAsync( array $args = [] )
 * @method Result associateDRTRole( array $args = [] )
 * @method Promise associateDRTRoleAsync( array $args = [] )
 * @method Result createProtection( array $args = [] )
 * @method Promise createProtectionAsync( array $args = [] )
 * @method Result createSubscription( array $args = [] )
 * @method Promise createSubscriptionAsync( array $args = [] )
 * @method Result deleteProtection( array $args = [] )
 * @method Promise deleteProtectionAsync( array $args = [] )
 * @method Result deleteSubscription( array $args = [] )
 * @method Promise deleteSubscriptionAsync( array $args = [] )
 * @method Result describeAttack( array $args = [] )
 * @method Promise describeAttackAsync( array $args = [] )
 * @method Result describeDRTAccess( array $args = [] )
 * @method Promise describeDRTAccessAsync( array $args = [] )
 * @method Result describeEmergencyContactSettings( array $args = [] )
 * @method Promise describeEmergencyContactSettingsAsync( array $args = [] )
 * @method Result describeProtection( array $args = [] )
 * @method Promise describeProtectionAsync( array $args = [] )
 * @method Result describeSubscription( array $args = [] )
 * @method Promise describeSubscriptionAsync( array $args = [] )
 * @method Result disassociateDRTLogBucket( array $args = [] )
 * @method Promise disassociateDRTLogBucketAsync( array $args = [] )
 * @method Result disassociateDRTRole( array $args = [] )
 * @method Promise disassociateDRTRoleAsync( array $args = [] )
 * @method Result getSubscriptionState( array $args = [] )
 * @method Promise getSubscriptionStateAsync( array $args = [] )
 * @method Result listAttacks( array $args = [] )
 * @method Promise listAttacksAsync( array $args = [] )
 * @method Result listProtections( array $args = [] )
 * @method Promise listProtectionsAsync( array $args = [] )
 * @method Result updateEmergencyContactSettings( array $args = [] )
 * @method Promise updateEmergencyContactSettingsAsync( array $args = [] )
 * @method Result updateSubscription( array $args = [] )
 * @method Promise updateSubscriptionAsync( array $args = [] )
 */
class ShieldClient extends AwsClient {
}
