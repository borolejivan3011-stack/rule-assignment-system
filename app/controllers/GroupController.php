<?php

require_once __DIR__ . '/../models/Group.php';
require_once __DIR__ . '/../models/GroupRule.php';

class GroupController
{
    private $groupModel;
    private $groupRuleModel;
    public function __construct()
    {
        $this->groupModel = new Group();
        $this->groupRuleModel = new GroupRule();
    }

    // create new group
    public function saveGroup($data)
    {
        $groupId = $this->groupModel->createGroup(
            $data['group_name']
        );

        $sortOrder = 1;
        foreach($data['rules'] as $rule)
        {
            $this->groupRuleModel->assignRule([

                'fk_group_id' => $groupId,
                'fk_rule_id' => $rule['rule_id'],
                'parent_rule_id' => $rule['parent_rule_id'] != ''
                    ? $rule['parent_rule_id']
                    : NULL,

                'tier' => $rule['tier'],
                'sort_order' => $sortOrder
            ]);

            $sortOrder++;
        }

        return true;
    }
}