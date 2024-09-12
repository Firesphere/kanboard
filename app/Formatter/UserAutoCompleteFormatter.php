<?php

namespace Kanboard\Formatter;

use Kanboard\Core\Filter\FormatterInterface;
use Kanboard\Core\User\UserProviderInterface;

/**
 * Auto-complete formatter for users
 *
 * @package  Kanboard\Formatter
 * @author   Frederic Guillot
 */
class UserAutoCompleteFormatter extends BaseFormatter implements FormatterInterface
{
    /**
     * Users found
     *
     * @access protected
     * @var UserProviderInterface[]
     */
    protected $users;

    /**
     * Set users
     *
     * @access public
     * @param UserProviderInterface[] $users
     * @return $this
     */
    public function withUsers(array $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Format the users for the ajax auto-completion
     *
     * @access public
     * @return array
     */
    public function format()
    {
        $result = [];

        foreach ($this->users as $user) {
            $result[] = [
                'id'                 => $user->getInternalId(),
                'username'           => $user->getUsername(),
                'external_id'        => $user->getExternalId(),
                'external_id_column' => $user->getExternalIdColumn(),
                'value'              => $user->getName() === '' ? $user->getUsername() : $user->getName(),
                'label'              => $user->getName() === '' ? $user->getUsername() : $user->getName() . ' (' . $user->getUsername() . ')',
            ];
        }

        return $result;
    }
}
