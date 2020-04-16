<?php

namespace Aws\FMS;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Firewall Management Service** service.
 * @method Result associateAdminAccount( array $args = [] )
 * @method Promise associateAdminAccountAsync( array $args = [] )
 * @method Result deleteNotificationChannel( array $args = [] )
 * @method Promise deleteNotificationChannelAsync( array $args = [] )
 * @method Result deletePolicy( array $args = [] )
 * @method Promise deletePolicyAsync( array $args = [] )
 * @method Result disassociateAdminAccount( array $args = [] )
 * @method Promise disassociateAdminAccountAsync( array $args = [] )
 * @method Result getAdminAccount( array $args = [] )
 * @method Promise getAdminAccountAsync( array $args = [] )
 * @method Result getComplianceDetail( array $args = [] )
 * @method Promise getComplianceDetailAsync( array $args = [] )
 * @method Result getNotificationChannel( array $args = [] )
 * @method Promise getNotificationChannelAsync( array $args = [] )
 * @method Result getPolicy( array $args = [] )
 * @method Promise getPolicyAsync( array $args = [] )
 * @method Result getProtectionStatus( array $args = [] )
 * @method Promise getProtectionStatusAsync( array $args = [] )
 * @method Result listComplianceStatus( array $args = [] )
 * @method Promise listComplianceStatusAsync( array $args = [] )
 * @method Result listMemberAccounts( array $args = [] )
 * @method Promise listMemberAccountsAsync( array $args = [] )
 * @method Result listPolicies( array $args = [] )
 * @method Promise listPoliciesAsync( array $args = [] )
 * @method Result putNotificationChannel( array $args = [] )
 * @method Promise putNotificationChannelAsync( array $args = [] )
 * @method Result putPolicy( array $args = [] )
 * @method Promise putPolicyAsync( array $args = [] )
 */
class FMSClient extends AwsClient {
}
