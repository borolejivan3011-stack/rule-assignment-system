var rules = [];
var assignedRules = [];
$(document).ready(function(){
    loadRules();
    loadGroupDetails();
    $('#add_rule').click(function(){
        addRule();
    });

    $('#update_group').click(function(){
        updateGroup();
    });

});

function loadRules()
{
    $.getJSON('./app/api/get-rules.php', function(data){
        rules = data;
        $('#rule_id').html('<option value="">Select Rule</option>'
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

function loadGroupDetails()
{
    var groupId = $('#group_id').val();
    $.getJSON('./app/api/get-groups.php', function(groups){
        var selectedGroup = groups.find(function(group){
            return group.group_id == groupId;
        });

        if(selectedGroup)
        {
            $('#group_name').val(
                selectedGroup.group_name
            );
        }

    });

    $.getJSON('./app/api/get-group.php?group_id='+groupId, function(data){

        assignedRules = [];
        $.each(data, function(index, rule){
            assignedRules.push({
                rule_id : rule.fk_rule_id,
                rule_name : rule.rule_name,
                rule_type : rule.rule_type,
                parent_rule_id : rule.parent_rule_id,
                tier : rule.tier
            });
        });
        refreshAssignedRules();

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

    var selectedRule = rules.find(function(rule){ 
    return rule.rule_id == ruleId;

    });

    assignedRules.push({
        rule_id : selectedRule.rule_id,
        rule_name : selectedRule.rule_name,
        rule_type : selectedRule.rule_type,
        parent_rule_id : parentRuleId,
        tier : tier
    });

    refreshAssignedRules();
}

function refreshAssignedRules()
{
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

function updateGroup()
{
    var groupId = $('#group_id').val();
    var groupName = $('#group_name').val();
    if(groupName == '')
    {
        alert('Please enter group name');
        return;
    }

    var payload = {
        group_id : groupId,
        group_name : groupName,
        rules : assignedRules
    };

    $.ajax({
        url : './app/api/update-group.php',
        type : 'POST',
        contentType : 'application/json',
        data : JSON.stringify(payload),

        success : function(response)
        {            alert(response.message);
            if(response.status)
            {
                window.location.href = './groups';
            }
        }

    });
}