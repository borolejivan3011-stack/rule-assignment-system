var rules = [];
var assignedRules = [];

$(document).ready(function(){

    loadRules();
    $('#add_rule').click(function(){
        addRule();

    });
    $('#save_group').click(function(){
        saveGroup();
    });

});

function loadRules()
{
    $.getJSON('./app/api/get-rules.php', function(data){
        rules = data;
        $('#rule_id').html(
            '<option value="">Select Rule</option>'
        );

        $.each(data, function(index, rule){
            $('#rule_id').append(
                '<option value="'+rule.rule_id+'">'+
                    rule.rule_name+' - '+rule.rule_type+
                '</option>'
            );
        });
    });
}

function addRule()
{
    var ruleId = $('#rule_id').val();
    var parentRuleId = $('#parent_rule_id').val();
    var tier = $('#tier').val();
    if(ruleId == '')
    {
        alert('Please select rule'); return;
    }

    if(tier > 3)
    {
        alert('Maximum 3 tiers allowed');
        return;
    }

    var selectedRule = rules.find(function(rule){
        return rule.rule_id == ruleId;
    });

    var duplicate = assignedRules.find(function(rule){
        return (
            rule.rule_id == ruleId &&
            rule.parent_rule_id == parentRuleId
        );

    });

    if(duplicate)
    {
        alert('Rule already assigned under same parent');        return;
    }

    assignedRules.push({

        rule_id : selectedRule.rule_id,
        rule_name : selectedRule.rule_name,
        rule_type : selectedRule.rule_type,
        parent_rule_id : parentRuleId,
        tier : tier
    });

    refreshAssignedRules();
    $('#rule_id').val('');
    $('#parent_rule_id').val('');
    $('#tier').val('1');
}

function refreshAssignedRules()
{
    $('#assigned_box').show();
    $('#assigned_rules_table').html('');
    $('#parent_rule_id').html(
        '<option value="">Root Rule</option>'
    );

    $.each(assignedRules, function(index, rule){
        var row = '';
        row += '<tr>';
        row += '<td>'+rule.rule_name+'</td>';
        row += '<td>'+rule.rule_type+'</td>';
        row += '<td>';
        if(rule.parent_rule_id)
        {
            row += rule.parent_rule_id;
        }
        else
        {
            row += 'Root';
        }

        row += '</td>';
        row += '<td>'+rule.tier+'</td>';
        row += '<td>';
        row += '<button class="btn btn-danger btn-sm remove-rule" data-index="'+index+'">';

        row += 'Remove';
        row += '</button>';
        row += '</td>';
        row += '</tr>';

        $('#assigned_rules_table').append(row);
        $('#parent_rule_id').append(
            '<option value="'+rule.rule_id+'">'+
                rule.rule_name+
            '</option>'
        );
    });
}

$(document).on('click', '.remove-rule', function(){
    var index = $(this).data('index');
    assignedRules.splice(index, 1);
    refreshAssignedRules();
});

function saveGroup()
{
    var groupName = $('#group_name').val();
    if(groupName == '')
    {
        alert('Please enter group name');return;
    }

    if(assignedRules.length == 0)
    {
        alert('Please add at least one rule'); return;
    }

    var payload = { group_name : groupName,
        rules : assignedRules
    };

    $.ajax({
        url : './app/api/save-group.php',
        type : 'POST',
        contentType : 'application/json',
        data : JSON.stringify(payload),
        success : function(response)
        {
            alert(response.message);
            if(response.status)
            {
               window.location.href = './groups';
            }
        }

    });
}