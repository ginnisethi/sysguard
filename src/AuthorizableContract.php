<?php namespace Ifaniqbal\Sysguard;

interface AuthorizableContract {

    /**
     * Set group model.
     *
     * @return mixed
     */
    public function setGroupModel($model);

    /**
     * Get group model.
     *
     * @return mixed
     */
    public function getGroupModel();

    /**
     * Get active (current role) group .
     *
     * @return mixed
     */
    public function getActiveGroup();

    /**
     * Set active (current role) group.
     *
     * @return mixed
     */
    public function setActiveGroup($group);

    /**
     * Get the id of active (current role) group .
     *
     * @return mixed
     */
    public function getActiveGroupId();

    /**
     * Set the id of active (current role) group.
     *
     * @return mixed
     */
    public function setActiveGroupId($group_id);

}
