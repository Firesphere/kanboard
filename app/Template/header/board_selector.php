<?= $this->app->component('select-dropdown-autocomplete', [
    'name'        => 'boardId',
    'placeholder' => t('Display another project'),
    'ariaLabel'   => t('Display another project'),
    'items'       => $board_selector,
    'redirect'    => [
        'regex' => 'PROJECT_ID',
        'url'   => $this->url->to('BoardViewController', 'show', ['project_id' => 'PROJECT_ID']),
    ],
    'onFocus' => [
        'board.selector.open',
    ],
]) ?>

