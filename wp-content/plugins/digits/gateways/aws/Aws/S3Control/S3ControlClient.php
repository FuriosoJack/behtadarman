<?php

namespace Aws\S3Control;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS S3 Control** service.
 * @method Result createJob( array $args = [] )
 * @method Promise createJobAsync( array $args = [] )
 * @method Result deletePublicAccessBlock( array $args = [] )
 * @method Promise deletePublicAccessBlockAsync( array $args = [] )
 * @method Result describeJob( array $args = [] )
 * @method Promise describeJobAsync( array $args = [] )
 * @method Result getPublicAccessBlock( array $args = [] )
 * @method Promise getPublicAccessBlockAsync( array $args = [] )
 * @method Result listJobs( array $args = [] )
 * @method Promise listJobsAsync( array $args = [] )
 * @method Result putPublicAccessBlock( array $args = [] )
 * @method Promise putPublicAccessBlockAsync( array $args = [] )
 * @method Result updateJobPriority( array $args = [] )
 * @method Promise updateJobPriorityAsync( array $args = [] )
 * @method Result updateJobStatus( array $args = [] )
 * @method Promise updateJobStatusAsync( array $args = [] )
 */
class S3ControlClient extends AwsClient {
	/**
	 * {@inheritdoc}
	 *
	 * In addition to the options available to
	 * {@see Aws\AwsClient::__construct}, S3ControlClient accepts the following
	 * option:
	 *
	 * - use_dual_stack_endpoint: (bool) Set to true to send requests to an S3
	 *   Control Dual Stack endpoint by default, which enables IPv6 Protocol.
	 *   Can be enabled or disabled on individual operations by setting
	 *   '@use_dual_stack_endpoint\' to true or false. Note:
	 *   you cannot use it together with an accelerate endpoint.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$stack = $this->getHandlerList();
		$stack->appendBuild(
			S3ControlEndpointMiddleware::wrap(
				$this->getRegion(),
				[
					'dual_stack' => $this->getConfig( 'use_dual_stack_endpoint' ),
				]
			),
			's3control.endpoint_middleware'
		);
	}

	public static function getArguments() {
		$args = parent::getArguments();

		return $args + [
				'use_dual_stack_endpoint' => [
					'type'    => 'config',
					'valid'   => [ 'bool' ],
					'doc'     => 'Set to true to send requests to an S3 Control Dual Stack'
					             . ' endpoint by default, which enables IPv6 Protocol.'
					             . ' Can be enabled or disabled on individual operations by setting'
					             . ' \'@use_dual_stack_endpoint\' to true or false.',
					'default' => false,
				],
			];
	}
}
