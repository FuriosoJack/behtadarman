<?php

namespace Aws\Budgets;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Budgets** service.
 * @method Result createBudget( array $args = [] )
 * @method Promise createBudgetAsync( array $args = [] )
 * @method Result createNotification( array $args = [] )
 * @method Promise createNotificationAsync( array $args = [] )
 * @method Result createSubscriber( array $args = [] )
 * @method Promise createSubscriberAsync( array $args = [] )
 * @method Result deleteBudget( array $args = [] )
 * @method Promise deleteBudgetAsync( array $args = [] )
 * @method Result deleteNotification( array $args = [] )
 * @method Promise deleteNotificationAsync( array $args = [] )
 * @method Result deleteSubscriber( array $args = [] )
 * @method Promise deleteSubscriberAsync( array $args = [] )
 * @method Result describeBudget( array $args = [] )
 * @method Promise describeBudgetAsync( array $args = [] )
 * @method Result describeBudgetPerformanceHistory( array $args = [] )
 * @method Promise describeBudgetPerformanceHistoryAsync( array $args = [] )
 * @method Result describeBudgets( array $args = [] )
 * @method Promise describeBudgetsAsync( array $args = [] )
 * @method Result describeNotificationsForBudget( array $args = [] )
 * @method Promise describeNotificationsForBudgetAsync( array $args = [] )
 * @method Result describeSubscribersForNotification( array $args = [] )
 * @method Promise describeSubscribersForNotificationAsync( array $args = [] )
 * @method Result updateBudget( array $args = [] )
 * @method Promise updateBudgetAsync( array $args = [] )
 * @method Result updateNotification( array $args = [] )
 * @method Promise updateNotificationAsync( array $args = [] )
 * @method Result updateSubscriber( array $args = [] )
 * @method Promise updateSubscriberAsync( array $args = [] )
 */
class BudgetsClient extends AwsClient {
}
