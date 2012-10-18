<?php

/**
 *  Class Base_Controller_Action
 *  @author Willem Daems
 *  @package ThinkFW
 *  @subpackage Access
 *
 */

class Access_Privileges
{

    public static function grantRoles($userId, Array $roles)
    {
        $db = Base_DbUtil::getDatabase();
        self::removeRoles($userId);
        foreach ($roles as $key => &$value)
        {
            $db->insert('user_roles', array(
                'id_user' => $userId,
                'id_group' => $value
            ));
        }
    }

    public static function grantTemporaryRoles($userId, Array $roles, $date)
    {
        $db = Base_DbUtil::getDatabase();

        foreach ($roles as $key => &$value)
        {
            $db->insert('user_roles', array(
                'id_user' => $userId,
                'id_group' => $value,
                'expires' => $date
            ));
        }
    }

    public static function setRolePrivileges($privileges, $groupId)
    {
        $db = Base_DbUtil::getDatabase();
        self::removeRolePrivileges($groupId);

        $_privileges = Array();

        foreach ($privileges as $key => &$value)
        {
            $_privileges[$value] = 1;
        }

        $select = $db->query("SELECT * FROM user_tasks");
        $result = $select->fetchAll();

        while (list($index, $row) = each($result))
        {
            $permission =  isset($_privileges[$row['id']]) ? 'allow' : 'deny';

            $db->insert('user_permissions', array(
                    'id_task' => $row['id'],
                    'id_group' => $groupId,
                    'permission' => $permission
            ));
        }
    }

    public static function removeRolePrivileges($groupId)
    {
        $db = Base_DbUtil::getDatabase();
        $db->delete('user_permissions', $db->quoteInto("id_group = ?", $groupId));
    }

    public static function removeRoles($userId)
    {
        $db = Base_DbUtil::getDatabase();
        $db->delete('user_roles', $db->quoteInto("id_user = ?", $userId));
    }

    public static function getUserPrivileges($userId)
    {
        $db = Base_DbUtil::getDatabase();
        $privileges = Array();
        $select = $db->query("
            SELECT *, user_tasks.task FROM user_roles
            LEFT JOIN
                    user_permissions ON user_roles.id_group = user_permissions.id_group
            LEFT JOIN
                    user_tasks ON user_permissions.id_task = user_tasks.id
            WHERE id_user = '" . (int) $userId . "'
        ");

        $result = $select->fetchAll();

        while (list($index, $row) = each($result))
        {
                if (!isset($privileges[$row['task']]))
                {
                        $privileges[$row['task']] = $row['permission'];
                } else {
                        if ($privileges[$row['task']] != 'allow')
                        {
                                $privileges[$row['task']] = $row['permission'];
                        }
                }
        }

        $ns = new Zend_Session_Namespace('TicketsUserData');
        $ns->userPrivileges = $privileges;
    }

    public static function hasPrivilege($part, $action)
    {
        $ns = new Zend_Session_Namespace('TicketsUserData');

        if (!isset($ns->userPrivileges)) {
            self::getUserPrivileges($ns->userData['id']);
        }

        $privilege = ucfirst($action) . ucfirst($part);

        if (!isset($ns->userPrivileges[$privilege])) {
            return false;
        }

        if ($ns->userPrivileges[$privilege] == 'allow') {
            return true;
        } else {
            return false;
        }
    }
}