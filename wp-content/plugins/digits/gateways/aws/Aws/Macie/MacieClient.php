<?php

namespace Aws\Macie;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Macie** service.
 * @method Result associateMemberAccount( array $args = [] )
 * @method Promise associateMemberAccountAsync( array $args = [] )
 * @method Result associateS3Resources( array $args = [] )
 * @method Promise associateS3ResourcesAsync( array $args = [] )
 * @method Result disassociateMemberAccount( array $args = [] )
 * @method Promise disassociateMemberAccountAsync( array $args = [] )
 * @method Result disassociateS3Resources( array $args = [] )
 * @method Promise disassociateS3ResourcesAsync( array $args = [] )
 * @method Result listMemberAccounts( array $args = [] )
 * @method Promise listMemberAccountsAsync( array $args = [] )
 * @method Result listS3Resources( array $args = [] )
 * @method Promise listS3ResourcesAsync( array $args = [] )
 * @method Result updateS3Resources( array $args = [] )
 * @method Promise updateS3ResourcesAsync( array $args = [] )
 */
class MacieClient extends AwsClient {
}
