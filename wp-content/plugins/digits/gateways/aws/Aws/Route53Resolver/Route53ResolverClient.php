<?php

namespace Aws\Route53Resolver;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Route 53 Resolver** service.
 * @method Result associateResolverEndpointIpAddress( array $args = [] )
 * @method Promise associateResolverEndpointIpAddressAsync( array $args = [] )
 * @method Result associateResolverRule( array $args = [] )
 * @method Promise associateResolverRuleAsync( array $args = [] )
 * @method Result createResolverEndpoint( array $args = [] )
 * @method Promise createResolverEndpointAsync( array $args = [] )
 * @method Result createResolverRule( array $args = [] )
 * @method Promise createResolverRuleAsync( array $args = [] )
 * @method Result deleteResolverEndpoint( array $args = [] )
 * @method Promise deleteResolverEndpointAsync( array $args = [] )
 * @method Result deleteResolverRule( array $args = [] )
 * @method Promise deleteResolverRuleAsync( array $args = [] )
 * @method Result disassociateResolverEndpointIpAddress( array $args = [] )
 * @method Promise disassociateResolverEndpointIpAddressAsync( array $args = [] )
 * @method Result disassociateResolverRule( array $args = [] )
 * @method Promise disassociateResolverRuleAsync( array $args = [] )
 * @method Result getResolverEndpoint( array $args = [] )
 * @method Promise getResolverEndpointAsync( array $args = [] )
 * @method Result getResolverRule( array $args = [] )
 * @method Promise getResolverRuleAsync( array $args = [] )
 * @method Result getResolverRuleAssociation( array $args = [] )
 * @method Promise getResolverRuleAssociationAsync( array $args = [] )
 * @method Result getResolverRulePolicy( array $args = [] )
 * @method Promise getResolverRulePolicyAsync( array $args = [] )
 * @method Result listResolverEndpointIpAddresses( array $args = [] )
 * @method Promise listResolverEndpointIpAddressesAsync( array $args = [] )
 * @method Result listResolverEndpoints( array $args = [] )
 * @method Promise listResolverEndpointsAsync( array $args = [] )
 * @method Result listResolverRuleAssociations( array $args = [] )
 * @method Promise listResolverRuleAssociationsAsync( array $args = [] )
 * @method Result listResolverRules( array $args = [] )
 * @method Promise listResolverRulesAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result putResolverRulePolicy( array $args = [] )
 * @method Promise putResolverRulePolicyAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateResolverEndpoint( array $args = [] )
 * @method Promise updateResolverEndpointAsync( array $args = [] )
 * @method Result updateResolverRule( array $args = [] )
 * @method Promise updateResolverRuleAsync( array $args = [] )
 */
class Route53ResolverClient extends AwsClient {
}
