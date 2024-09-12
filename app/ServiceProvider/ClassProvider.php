<?php

namespace Kanboard\ServiceProvider;

use Kanboard\Core\Http\Client as HttpClient;
use Kanboard\Core\Http\OAuth2;
use Kanboard\Core\Paginator;
use Kanboard\Core\Tool;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ClassProvider
 *
 * @package Kanboard\ServiceProvider
 * @author  Frederic Guillot
 */
class ClassProvider implements ServiceProviderInterface
{
    private $classes = [
        'Analytic' => [
            'TaskDistributionAnalytic',
            'UserDistributionAnalytic',
            'EstimatedTimeComparisonAnalytic',
            'AverageLeadCycleTimeAnalytic',
            'AverageTimeSpentColumnAnalytic',
            'EstimatedActualColumnAnalytic',
        ],
        'Model' => [
            'ActionModel',
            'ActionParameterModel',
            'AvatarFileModel',
            'BoardModel',
            'CategoryModel',
            'ColorModel',
            'ColumnModel',
            'ColumnRestrictionModel',
            'ColumnMoveRestrictionModel',
            'CommentModel',
            'ConfigModel',
            'CurrencyModel',
            'CustomFilterModel',
            'GroupModel',
            'GroupMemberModel',
            'InviteModel',
            'LanguageModel',
            'LastLoginModel',
            'LinkModel',
            'NotificationModel',
            'PasswordResetModel',
            'PredefinedTaskDescriptionModel',
            'ProjectModel',
            'ProjectFileModel',
            'ProjectActivityModel',
            'ProjectDuplicationModel',
            'ProjectDailyColumnStatsModel',
            'ProjectDailyStatsModel',
            'ProjectPermissionModel',
            'ProjectNotificationModel',
            'ProjectMetadataModel',
            'ProjectGroupRoleModel',
            'ProjectRoleModel',
            'ProjectRoleRestrictionModel',
            'ProjectTaskDuplicationModel',
            'ProjectTaskPriorityModel',
            'ProjectUserRoleModel',
            'RememberMeSessionModel',
            'SubtaskModel',
            'SubtaskPositionModel',
            'SubtaskStatusModel',
            'SubtaskTaskConversionModel',
            'SubtaskTimeTrackingModel',
            'SwimlaneModel',
            'TagDuplicationModel',
            'TagModel',
            'TaskModel',
            'TaskAnalyticModel',
            'TaskCreationModel',
            'TaskDuplicationModel',
            'TaskProjectDuplicationModel',
            'TaskProjectMoveModel',
            'TaskRecurrenceModel',
            'TaskExternalLinkModel',
            'TaskFinderModel',
            'TaskFileModel',
            'TaskLinkModel',
            'TaskModificationModel',
            'TaskPositionModel',
            'TaskReorderModel',
            'TaskStatusModel',
            'TaskTagModel',
            'TaskMetadataModel',
            'ThemeModel',
            'TimezoneModel',
            'TransitionModel',
            'UserModel',
            'UserLockingModel',
            'UserNotificationModel',
            'UserNotificationFilterModel',
            'UserUnreadNotificationModel',
            'UserMetadataModel',
        ],
        'Validator' => [
            'ActionValidator',
            'AuthValidator',
            'CategoryValidator',
            'ColumnMoveRestrictionValidator',
            'ColumnRestrictionValidator',
            'ColumnValidator',
            'CommentValidator',
            'CurrencyValidator',
            'CustomFilterValidator',
            'ExternalLinkValidator',
            'GroupValidator',
            'LinkValidator',
            'PasswordResetValidator',
            'ProjectValidator',
            'ProjectRoleValidator',
            'SubtaskValidator',
            'SwimlaneValidator',
            'TagValidator',
            'TaskLinkValidator',
            'TaskValidator',
            'UserValidator',
            'PredefinedTaskDescriptionValidator',
        ],
        'Import' => [
            'UserImport',
        ],
        'Export' => [
            'SubtaskExport',
            'TaskExport',
            'TransitionExport',
        ],
        'Pagination' => [
            'DashboardPagination',
            'ProjectPagination',
            'SubtaskPagination',
            'TaskPagination',
            'UserPagination',
        ],
        'Core' => [
            'DateParser',
            'Lexer',
        ],
        'Core\Event' => [
            'EventManager',
        ],
        'Core\Http' => [
            'Request',
            'Response',
            'RememberMeCookie',
        ],
        'Core\Plugin' => [
            'Hook',
        ],
        'Core\Security' => [
            'Token',
            'Role',
        ],
        'Core\User' => [
            'GroupSync',
            'UserSync',
            'UserSession',
            'UserProfile',
        ],
    ];

    public function register(Container $container)
    {
        Tool::buildDIC($container, $this->classes);

        $container['paginator'] = $container->factory(function ($c) {
            return new Paginator($c);
        });

        $container['oauth'] = $container->factory(function ($c) {
            return new OAuth2($c);
        });

        $container['httpClient'] = function ($c) {
            return new HttpClient($c);
        };

        $container['cspRules'] = [
            'default-src' => "'self'",
            'style-src'   => "'self' 'unsafe-inline'",
            'img-src'     => '* data:',
        ];

        return $container;
    }
}
