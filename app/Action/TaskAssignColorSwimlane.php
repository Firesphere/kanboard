<?php

namespace Kanboard\Action;

use Kanboard\Model\TaskModel;

/**
 * Assign a color to a task based on Swimlane
 *
 * @package Kanboard\Action
 * @author  Dave Almond
 */
class TaskAssignColorSwimlane extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Assign a color when the task is moved to a specific swimlane');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return [
            TaskModel::EVENT_CREATE,
            TaskModel::EVENT_MOVE_SWIMLANE,
        ];
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return [
            'swimlane_id' => t('Swimlane'),
            'color_id'    => t('Color'),
        ];
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return [
            'task_id',
            'task' => [
                'project_id',
                'swimlane_id',
            ],
        ];
    }

    /**
     * Execute the action (set the task color)
     *
     * @access public
     * @param array $data Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        $values = [
            'id'       => $data['task_id'],
            'color_id' => $this->getParam('color_id'),
        ];

        return $this->taskModificationModel->update($values, false);
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param array $data Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return $data['task']['swimlane_id'] == $this->getParam('swimlane_id');
    }
}
