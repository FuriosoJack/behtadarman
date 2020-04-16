<?php

namespace Aws\Textract;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Textract** service.
 * @method Result analyzeDocument( array $args = [] )
 * @method Promise analyzeDocumentAsync( array $args = [] )
 * @method Result detectDocumentText( array $args = [] )
 * @method Promise detectDocumentTextAsync( array $args = [] )
 * @method Result getDocumentAnalysis( array $args = [] )
 * @method Promise getDocumentAnalysisAsync( array $args = [] )
 * @method Result getDocumentTextDetection( array $args = [] )
 * @method Promise getDocumentTextDetectionAsync( array $args = [] )
 * @method Result startDocumentAnalysis( array $args = [] )
 * @method Promise startDocumentAnalysisAsync( array $args = [] )
 * @method Result startDocumentTextDetection( array $args = [] )
 * @method Promise startDocumentTextDetectionAsync( array $args = [] )
 */
class TextractClient extends AwsClient {
}
