<?php

namespace Kanboard\Filter;

use Kanboard\Core\Filter\FilterInterface;
use Kanboard\Model\ProjectModel;
use Kanboard\Model\TaskModel;

/**
 * Filter tasks by project
 *
 * @package filter
 * @author  Frederic Guillot
 */
class TaskProjectFilter extends BaseFilter implements FilterInterface
{
    /**
     * Get search attribute
     *
     * @access public
     * @return string[]
     */
    public function getAttributes()
    {
        return ['project'];
    }

    /**
     * Apply filter
     *
     * @access public
     * @return FilterInterface
     */
    public function apply()
    {
        // Max integer value for Postgres is +2147483647
        // See https://www.postgresql.org/docs/current/datatype-numeric.html
        if (is_int($this->value) || ctype_digit((string)$this->value) && $this->value < 2147483647) {
            $this->query->eq(TaskModel::TABLE . '.project_id', $this->value);
        } else {
            $this->query->ilike(ProjectModel::TABLE . '.name', $this->value);
        }

        return $this;
    }
}
