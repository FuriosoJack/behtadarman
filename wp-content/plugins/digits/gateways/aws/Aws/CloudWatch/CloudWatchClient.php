<?php

namespace Aws\CloudWatch;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon CloudWatch** service.
 *
 * @method Result deleteAlarms( array $args = [] )
 * @method Promise deleteAlarmsAsync( array $args = [] )
 * @method Result deleteAnomalyDetector( array $args = [] )
 * @method Promise deleteAnomalyDetectorAsync( array $args = [] )
 * @method Result deleteDashboards( array $args = [] )
 * @method Promise deleteDashboardsAsync( array $args = [] )
 * @method Result describeAlarmHistory( array $args = [] )
 * @method Promise describeAlarmHistoryAsync( array $args = [] )
 * @method Result describeAlarms( array $args = [] )
 * @method Promise describeAlarmsAsync( array $args = [] )
 * @method Result describeAlarmsForMetric( array $args = [] )
 * @method Promise describeAlarmsForMetricAsync( array $args = [] )
 * @method Result describeAnomalyDetectors( array $args = [] )
 * @method Promise describeAnomalyDetectorsAsync( array $args = [] )
 * @method Result disableAlarmActions( array $args = [] )
 * @method Promise disableAlarmActionsAsync( array $args = [] )
 * @method Result enableAlarmActions( array $args = [] )
 * @method Promise enableAlarmActionsAsync( array $args = [] )
 * @method Result getDashboard( array $args = [] )
 * @method Promise getDashboardAsync( array $args = [] )
 * @method Result getMetricData( array $args = [] )
 * @method Promise getMetricDataAsync( array $args = [] )
 * @method Result getMetricStatistics( array $args = [] )
 * @method Promise getMetricStatisticsAsync( array $args = [] )
 * @method Result getMetricWidgetImage( array $args = [] )
 * @method Promise getMetricWidgetImageAsync( array $args = [] )
 * @method Result listDashboards( array $args = [] )
 * @method Promise listDashboardsAsync( array $args = [] )
 * @method Result listMetrics( array $args = [] )
 * @method Promise listMetricsAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result putAnomalyDetector( array $args = [] )
 * @method Promise putAnomalyDetectorAsync( array $args = [] )
 * @method Result putDashboard( array $args = [] )
 * @method Promise putDashboardAsync( array $args = [] )
 * @method Result putMetricAlarm( array $args = [] )
 * @method Promise putMetricAlarmAsync( array $args = [] )
 * @method Result putMetricData( array $args = [] )
 * @method Promise putMetricDataAsync( array $args = [] )
 * @method Result setAlarmState( array $args = [] )
 * @method Promise setAlarmStateAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 */
class CloudWatchClient extends AwsClient {
}
