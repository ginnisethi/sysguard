<?php namespace Ifaniqbal\Sysguard;

trait Authorizable {

    protected $groupModel;
    
    /**
     * Set group model.
     *
     * @return mixed
     */
    public function setGroupModel($model)
    {
        $this->groupModel = $model;
    }

    /**
     * Get group model.
     *
     * @return mixed
     */
    public function getGroupModel()
    {
        return $this->groupModel;
    }

    /**
     * Get active (current role) group .
     *
     * @return mixed
     */
    public function getActiveGroup()
    {
        return $this->getGroupModel()->find(
            $this->getActiveGroupId());
    }

    /**
     * Set active (current role) group.
     *
     * @return mixed
     */
    public function setActiveGroup($group)
    {
        $this->setActiveGroupId($group->id);
    }

    /**
     * Get the id of active (current role) group .
     *
     * @return mixed
     */
    public function getActiveGroupId()
    {
        if ($this->active_group_id != 0)
        {
            if ($this->groups()->where('group_id', $this->active_group_id)->exists()) {
                return $this->active_group_id;
            } else {
                $this->setActiveGroupId(0);
                
                return 0;
            }
        }
        else
        {
            if ($this->groups->count() > 0)
            {
                $group_id = $this->groups->sortByDesc('level')->first()->id;
                $this->setActiveGroupId($group_id);
                return $this->getActiveGroupId();
            }
            else
            {
                return 0;
            }
        }
    }

    /**
     * Set the id of active (current role) group.
     *
     * @return mixed
     */
    public function setActiveGroupId($group_id)
    {
        $this->active_group_id = $group_id;
        $this->save();
    }
}