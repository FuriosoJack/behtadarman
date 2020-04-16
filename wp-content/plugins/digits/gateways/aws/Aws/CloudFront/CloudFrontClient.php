<?php

namespace Aws\CloudFront;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;
use InvalidArgumentException;

/**
 * This client is used to interact with the **Amazon CloudFront** service.
 *
 * @method Result createCloudFrontOriginAccessIdentity( array $args = [] )
 * @method Promise createCloudFrontOriginAccessIdentityAsync( array $args = [] )
 * @method Result createDistribution( array $args = [] )
 * @method Promise createDistributionAsync( array $args = [] )
 * @method Result createInvalidation( array $args = [] )
 * @method Promise createInvalidationAsync( array $args = [] )
 * @method Result createStreamingDistribution( array $args = [] )
 * @method Promise createStreamingDistributionAsync( array $args = [] )
 * @method Result deleteCloudFrontOriginAccessIdentity( array $args = [] )
 * @method Promise deleteCloudFrontOriginAccessIdentityAsync( array $args = [] )
 * @method Result deleteDistribution( array $args = [] )
 * @method Promise deleteDistributionAsync( array $args = [] )
 * @method Result deleteStreamingDistribution( array $args = [] )
 * @method Promise deleteStreamingDistributionAsync( array $args = [] )
 * @method Result getCloudFrontOriginAccessIdentity( array $args = [] )
 * @method Promise getCloudFrontOriginAccessIdentityAsync( array $args = [] )
 * @method Result getCloudFrontOriginAccessIdentityConfig( array $args = [] )
 * @method Promise getCloudFrontOriginAccessIdentityConfigAsync( array $args = [] )
 * @method Result getDistribution( array $args = [] )
 * @method Promise getDistributionAsync( array $args = [] )
 * @method Result getDistributionConfig( array $args = [] )
 * @method Promise getDistributionConfigAsync( array $args = [] )
 * @method Result getInvalidation( array $args = [] )
 * @method Promise getInvalidationAsync( array $args = [] )
 * @method Result getStreamingDistribution( array $args = [] )
 * @method Promise getStreamingDistributionAsync( array $args = [] )
 * @method Result getStreamingDistributionConfig( array $args = [] )
 * @method Promise getStreamingDistributionConfigAsync( array $args = [] )
 * @method Result listCloudFrontOriginAccessIdentities( array $args = [] )
 * @method Promise listCloudFrontOriginAccessIdentitiesAsync( array $args = [] )
 * @method Result listDistributions( array $args = [] )
 * @method Promise listDistributionsAsync( array $args = [] )
 * @method Result listDistributionsByWebACLId( array $args = [] )
 * @method Promise listDistributionsByWebACLIdAsync( array $args = [] )
 * @method Result listInvalidations( array $args = [] )
 * @method Promise listInvalidationsAsync( array $args = [] )
 * @method Result listStreamingDistributions( array $args = [] )
 * @method Promise listStreamingDistributionsAsync( array $args = [] )
 * @method Result updateCloudFrontOriginAccessIdentity( array $args = [] )
 * @method Promise updateCloudFrontOriginAccessIdentityAsync( array $args = [] )
 * @method Result updateDistribution( array $args = [] )
 * @method Promise updateDistributionAsync( array $args = [] )
 * @method Result updateStreamingDistribution( array $args = [] )
 * @method Promise updateStreamingDistributionAsync( array $args = [] )
 * @method Result createDistributionWithTags( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise createDistributionWithTagsAsync( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result createStreamingDistributionWithTags( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise createStreamingDistributionWithTagsAsync( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result listTagsForResource( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise listTagsForResourceAsync( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result tagResource( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise tagResourceAsync( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result untagResource( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise untagResourceAsync( array $args = [] ) ( supported in versions 2016-08-01, 2016-08-20, 2016-09-07, 2016-09-29, 2016-11-25, 2017-03-25, 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result deleteServiceLinkedRole( array $args = [] ) ( supported in versions 2017-03-25 )
 * @method Promise deleteServiceLinkedRoleAsync( array $args = [] ) ( supported in versions 2017-03-25 )
 * @method Result createFieldLevelEncryptionConfig( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise createFieldLevelEncryptionConfigAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result createFieldLevelEncryptionProfile( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise createFieldLevelEncryptionProfileAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result createPublicKey( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise createPublicKeyAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result deleteFieldLevelEncryptionConfig( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise deleteFieldLevelEncryptionConfigAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result deleteFieldLevelEncryptionProfile( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise deleteFieldLevelEncryptionProfileAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result deletePublicKey( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise deletePublicKeyAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result getFieldLevelEncryption( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise getFieldLevelEncryptionAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result getFieldLevelEncryptionConfig( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise getFieldLevelEncryptionConfigAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result getFieldLevelEncryptionProfile( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise getFieldLevelEncryptionProfileAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result getFieldLevelEncryptionProfileConfig( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise getFieldLevelEncryptionProfileConfigAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result getPublicKey( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise getPublicKeyAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result getPublicKeyConfig( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise getPublicKeyConfigAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result listFieldLevelEncryptionConfigs( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise listFieldLevelEncryptionConfigsAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result listFieldLevelEncryptionProfiles( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise listFieldLevelEncryptionProfilesAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result listPublicKeys( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise listPublicKeysAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result updateFieldLevelEncryptionConfig( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise updateFieldLevelEncryptionConfigAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result updateFieldLevelEncryptionProfile( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise updateFieldLevelEncryptionProfileAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Result updatePublicKey( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 * @method Promise updatePublicKeyAsync( array $args = [] ) ( supported in versions 2017-10-30, 2018-06-18, 2018-11-05, 2019-03-26 )
 */
class CloudFrontClient extends AwsClient {
	/**
	 * Create a signed Amazon CloudFront URL.
	 *
	 * This method accepts an array of configuration options:
	 *
	 * - url: (string)  URL of the resource being signed (can include query
	 *   string and wildcards). For example: rtmp://s5c39gqb8ow64r.cloudfront.net/videos/mp3_name.mp3
	 *   http://d111111abcdef8.cloudfront.net/images/horizon.jpg?size=large&license=yes
	 * - policy: (string) JSON policy. Use this option when creating a signed
	 *   URL for a custom policy.
	 * - expires: (int) UTC Unix timestamp used when signing with a canned
	 *   policy. Not required when passing a custom 'policy' option.
	 * - key_pair_id: (string) The ID of the key pair used to sign CloudFront
	 *   URLs for private distributions.
	 * - private_key: (string) The filepath ot the private key used to sign
	 *   CloudFront URLs for private distributions.
	 *
	 * @param array $options Array of configuration options used when signing
	 *
	 * @return string Signed URL with authentication parameters
	 * @throws InvalidArgumentException if url, key_pair_id, or private_key
	 *     were not specified.
	 * @link http://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/WorkingWithStreamingDistributions.html
	 */
	public function getSignedUrl( array $options ) {
		foreach ( [ 'url', 'key_pair_id', 'private_key' ] as $required ) {
			if ( ! isset( $options[ $required ] ) ) {
				throw new InvalidArgumentException( "$required is required" );
			}
		}

		$urlSigner = new UrlSigner(
			$options['key_pair_id'],
			$options['private_key']
		);

		return $urlSigner->getSignedUrl(
			$options['url'],
			isset( $options['expires'] ) ? $options['expires'] : null,
			isset( $options['policy'] ) ? $options['policy'] : null
		);
	}

	/**
	 * Create a signed Amazon CloudFront cookie.
	 *
	 * This method accepts an array of configuration options:
	 *
	 * - url: (string)  URL of the resource being signed (can include query
	 *   string and wildcards). For example: http://d111111abcdef8.cloudfront.net/images/horizon.jpg?size=large&license=yes
	 * - policy: (string) JSON policy. Use this option when creating a signed
	 *   URL for a custom policy.
	 * - expires: (int) UTC Unix timestamp used when signing with a canned
	 *   policy. Not required when passing a custom 'policy' option.
	 * - key_pair_id: (string) The ID of the key pair used to sign CloudFront
	 *   URLs for private distributions.
	 * - private_key: (string) The filepath ot the private key used to sign
	 *   CloudFront URLs for private distributions.
	 *
	 * @param array $options Array of configuration options used when signing
	 *
	 * @return array Key => value pairs of signed cookies to set
	 * @throws InvalidArgumentException if url, key_pair_id, or private_key
	 *     were not specified.
	 * @link http://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/WorkingWithStreamingDistributions.html
	 */
	public function getSignedCookie( array $options ) {
		foreach ( [ 'key_pair_id', 'private_key' ] as $required ) {
			if ( ! isset( $options[ $required ] ) ) {
				throw new InvalidArgumentException( "$required is required" );
			}
		}

		$cookieSigner = new CookieSigner(
			$options['key_pair_id'],
			$options['private_key']
		);

		return $cookieSigner->getSignedCookie(
			isset( $options['url'] ) ? $options['url'] : null,
			isset( $options['expires'] ) ? $options['expires'] : null,
			isset( $options['policy'] ) ? $options['policy'] : null
		);
	}
}
