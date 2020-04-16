<?php

namespace Aws\Sts;

use Aws\AwsClient;
use Aws\Credentials\Credentials;
use Aws\Result;
use DateTimeInterface;
use GuzzleHttp\Promise\Promise;
use InvalidArgumentException;

/**
 * This client is used to interact with the **AWS Security Token Service (AWS STS)**.
 *
 * @method Result assumeRole( array $args = [] )
 * @method Promise assumeRoleAsync( array $args = [] )
 * @method Result assumeRoleWithSAML( array $args = [] )
 * @method Promise assumeRoleWithSAMLAsync( array $args = [] )
 * @method Result assumeRoleWithWebIdentity( array $args = [] )
 * @method Promise assumeRoleWithWebIdentityAsync( array $args = [] )
 * @method Result decodeAuthorizationMessage( array $args = [] )
 * @method Promise decodeAuthorizationMessageAsync( array $args = [] )
 * @method Result getCallerIdentity( array $args = [] )
 * @method Promise getCallerIdentityAsync( array $args = [] )
 * @method Result getFederationToken( array $args = [] )
 * @method Promise getFederationTokenAsync( array $args = [] )
 * @method Result getSessionToken( array $args = [] )
 * @method Promise getSessionTokenAsync( array $args = [] )
 */
class StsClient extends AwsClient {
	/**
	 * Creates credentials from the result of an STS operations
	 *
	 * @param Result $result Result of an STS operation
	 *
	 * @return Credentials
	 * @throws InvalidArgumentException if the result contains no credentials
	 */
	public function createCredentials( Result $result ) {
		if ( ! $result->hasKey( 'Credentials' ) ) {
			throw new InvalidArgumentException( 'Result contains no credentials' );
		}

		$c = $result['Credentials'];

		return new Credentials(
			$c['AccessKeyId'],
			$c['SecretAccessKey'],
			isset( $c['SessionToken'] ) ? $c['SessionToken'] : null,
			isset( $c['Expiration'] ) && $c['Expiration'] instanceof DateTimeInterface
				? (int) $c['Expiration']->format( 'U' )
				: null
		);
	}
}
