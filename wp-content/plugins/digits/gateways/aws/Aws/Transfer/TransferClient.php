<?php

namespace Aws\Transfer;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Transfer for SFTP** service.
 * @method Result createServer( array $args = [] )
 * @method Promise createServerAsync( array $args = [] )
 * @method Result createUser( array $args = [] )
 * @method Promise createUserAsync( array $args = [] )
 * @method Result deleteServer( array $args = [] )
 * @method Promise deleteServerAsync( array $args = [] )
 * @method Result deleteSshPublicKey( array $args = [] )
 * @method Promise deleteSshPublicKeyAsync( array $args = [] )
 * @method Result deleteUser( array $args = [] )
 * @method Promise deleteUserAsync( array $args = [] )
 * @method Result describeServer( array $args = [] )
 * @method Promise describeServerAsync( array $args = [] )
 * @method Result describeUser( array $args = [] )
 * @method Promise describeUserAsync( array $args = [] )
 * @method Result importSshPublicKey( array $args = [] )
 * @method Promise importSshPublicKeyAsync( array $args = [] )
 * @method Result listServers( array $args = [] )
 * @method Promise listServersAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result listUsers( array $args = [] )
 * @method Promise listUsersAsync( array $args = [] )
 * @method Result startServer( array $args = [] )
 * @method Promise startServerAsync( array $args = [] )
 * @method Result stopServer( array $args = [] )
 * @method Promise stopServerAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result testIdentityProvider( array $args = [] )
 * @method Promise testIdentityProviderAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateServer( array $args = [] )
 * @method Promise updateServerAsync( array $args = [] )
 * @method Result updateUser( array $args = [] )
 * @method Promise updateUserAsync( array $args = [] )
 */
class TransferClient extends AwsClient {
}
