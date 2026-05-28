<?php

class RuleAssignmentService
{
    // validate max tier
    public function validateTier($tier)
    {
        if($tier > 3)
        {
            return false;
        }

        return true;
    }

    // duplicate check under same parent
    public function checkDuplicateRule(
        $rules,
        $ruleId,
        $parentRuleId
    )
    {
        foreach($rules as $rule)
        {
            if(
                $rule['rule_id'] == $ruleId &&
                $rule['parent_rule_id'] == $parentRuleId
            ){
                return true;
            }
        }

        return false;
    }
}