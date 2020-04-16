<?php

namespace Aws\ManagedBlockchain;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Managed Blockchain** service.
 * @method Result createMember( array $args = [] )
 * @method Promise createMemberAsync( array $args = [] )
 * @method Result createNetwork( array $args = [] )
 * @method Promise createNetworkAsync( array $args = [] )
 * @method Result createNode( array $args = [] )
 * @method Promise createNodeAsync( array $args = [] )
 * @method Result createProposal( array $args = [] )
 * @method Promise createProposalAsync( array $args = [] )
 * @method Result deleteMember( array $args = [] )
 * @method Promise deleteMemberAsync( array $args = [] )
 * @method Result deleteNode( array $args = [] )
 * @method Promise deleteNodeAsync( array $args = [] )
 * @method Result getMember( array $args = [] )
 * @method Promise getMemberAsync( array $args = [] )
 * @method Result getNetwork( array $args = [] )
 * @method Promise getNetworkAsync( array $args = [] )
 * @method Result getNode( array $args = [] )
 * @method Promise getNodeAsync( array $args = [] )
 * @method Result getProposal( array $args = [] )
 * @method Promise getProposalAsync( array $args = [] )
 * @method Result listInvitations( array $args = [] )
 * @method Promise listInvitationsAsync( array $args = [] )
 * @method Result listMembers( array $args = [] )
 * @method Promise listMembersAsync( array $args = [] )
 * @method Result listNetworks( array $args = [] )
 * @method Promise listNetworksAsync( array $args = [] )
 * @method Result listNodes( array $args = [] )
 * @method Promise listNodesAsync( array $args = [] )
 * @method Result listProposalVotes( array $args = [] )
 * @method Promise listProposalVotesAsync( array $args = [] )
 * @method Result listProposals( array $args = [] )
 * @method Promise listProposalsAsync( array $args = [] )
 * @method Result rejectInvitation( array $args = [] )
 * @method Promise rejectInvitationAsync( array $args = [] )
 * @method Result voteOnProposal( array $args = [] )
 * @method Promise voteOnProposalAsync( array $args = [] )
 */
class ManagedBlockchainClient extends AwsClient {
}
