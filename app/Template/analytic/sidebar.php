<div class="sidebar">
    <ul>
        <li <?= $this->app->checkMenuSelection('AnalyticController', 'taskDistribution') ?>>
            <?= $this->modal->replaceLink(t('Task distribution'), 'AnalyticController', 'taskDistribution', ['project_id' => $project['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('AnalyticController', 'userDistribution') ?>>
            <?= $this->modal->replaceLink(t('User repartition'), 'AnalyticController', 'userDistribution', ['project_id' => $project['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('AnalyticController', 'cfd') ?>>
            <?= $this->modal->replaceLink(t('Cumulative flow diagram'), 'AnalyticController', 'cfd', ['project_id' => $project['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('AnalyticController', 'burndown') ?>>
            <?= $this->modal->replaceLink(t('Burndown chart'), 'AnalyticController', 'burndown', ['project_id' => $project['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('AnalyticController', 'averageTimeByColumn') ?>>
            <?= $this->modal->replaceLink(t('Average time into each column'), 'AnalyticController', 'averageTimeByColumn', ['project_id' => $project['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('AnalyticController', 'leadAndCycleTime') ?>>
            <?= $this->modal->replaceLink(t('Lead and cycle time'), 'AnalyticController', 'leadAndCycleTime', ['project_id' => $project['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('AnalyticController', 'timeComparison') ?>>
            <?= $this->modal->replaceLink(t('Estimated vs actual time'), 'AnalyticController', 'timeComparison', ['project_id' => $project['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('AnalyticController', 'estimatedVsActualByColumn') ?>>
            <?= $this->modal->replaceLink(t('Estimated vs actual time per column'), 'AnalyticController', 'estimatedVsActualByColumn', ['project_id' => $project['id']]) ?>
        </li>

        <?= $this->hook->render('template:analytic:sidebar', ['project' => $project]) ?>
    </ul>
</div>
