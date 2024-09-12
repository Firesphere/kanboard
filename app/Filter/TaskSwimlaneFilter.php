<?php

namespace Kanboard\Filter;

use Kanboard\Core\Filter\FilterInterface;
use Kanboard\Model\SwimlaneModel;

/**
 * Filter tasks by swimlane
 *
 * @package filter
 * @author  Frederic Guillot
 */
class TaskSwimlaneFilter extends BaseFilter implements FilterInterface
{
    /**
     * Get search attribute
     *
     * @access public
     * @return string[]
     */
    public function getAttributes()
    {
        return ['swimlane'];
    }

    /**
     * Apply filter
     *
     * @access public
     * @return FilterInterface
     */
    public function apply()
    {
        $this->query->ilike(SwimlaneModel::TABLE . '.name', $this->value);
        return $this;
    }
}
