<?php

require_once __DIR__ . '/../models/Group.php';
require_once __DIR__ . '/../models/GroupRule.php';
require_once __DIR__ . '/../services/RuleAssignmentService.php';

class GroupController
{
    private $groupModel;
    private $groupRuleModel;
    private $ruleService;

    public function __construct()    {
        $this->groupModel = new Group();
        $this->groupRuleModel = new GroupRule();
        $this->ruleService = new RuleAssignmentService();
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
            if(!$this->ruleService->validateTier($rule['tier']))
            {
                return false;
            }

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