<?php

namespace Aws\ApplicationInsights;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon CloudWatch Application Insights** service.
 * @method Result createApplication( array $args = [] )
 * @method Promise createApplicationAsync( array $args = [] )
 * @method Result createComponent( array $args = [] )
 * @method Promise createComponentAsync( array $args = [] )
 * @method Result deleteApplication( array $args = [] )
 * @method Promise deleteApplicationAsync( array $args = [] )
 * @method Result deleteComponent( array $args = [] )
 * @method Promise deleteComponentAsync( array $args = [] )
 * @method Result describeApplication( array $args = [] )
 * @method Promise describeApplicationAsync( array $args = [] )
 * @method Result describeComponent( array $args = [] )
 * @method Promise describeComponentAsync( array $args = [] )
 * @method Result describeComponentConfiguration( array $args = [] )
 * @method Promise describeComponentConfigurationAsync( array $args = [] )
 * @method Result describeComponentConfigurationRecommendation( array $args = [] )
 * @method Promise describeComponentConfigurationRecommendationAsync( array $args = [] )
 * @method Result describeObservation( array $args = [] )
 * @method Promise describeObservationAsync( array $args = [] )
 * @method Result describeProblem( array $args = [] )
 * @method Promise describeProblemAsync( array $args = [] )
 * @method Result describeProblemObservations( array $args = [] )
 * @method Promise describeProblemObservationsAsync( array $args = [] )
 * @method Result listApplications( array $args = [] )
 * @method Promise listApplicationsAsync( array $args = [] )
 * @method Result listComponents( array $args = [] )
 * @method Promise listComponentsAsync( array $args = [] )
 * @method Result listProblems( array $args = [] )
 * @method Promise listProblemsAsync( array $args = [] )
 * @method Result updateComponent( array $args = [] )
 * @method Promise updateComponentAsync( array $args = [] )
 * @method Result updateComponentConfiguration( array $args = [] )
 * @method Promise updateComponentConfigurationAsync( array $args = [] )
 */
class ApplicationInsightsClient extends AwsClient {
}
