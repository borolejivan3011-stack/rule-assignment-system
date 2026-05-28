<?php include 'layout/header.php'; ?>
<div class="container mt-5 mb-5">

    <div class="d-flex justify-content-between mb-4">
        <h2>Saved Groups</h2>
        <a href="index.php" class="btn btn-primary">   Create New Group</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Group ID</th>
                <th>Group Name</th>
                <th>Created At</th>
                <th>Hierarchy</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="group_table">
            <tr> <td colspan="5">Loading...</td></tr>
        </tbody>
    </table>
</div>

<script>

$(document).ready(function(){

    loadGroups();

});

function loadGroups()
{
    $.getJSON('./api/get-groups.php', function(data){

        var html = '';

        if(data.length == 0)
        {
            html += '<tr>';
            html += '<td colspan="5">No groups found</td>';
            html += '</tr>';
        }

        $.each(data, function(index, group){

            html += '<tr>';

            html += '<td>'+group.group_id+'</td>';
            html += '<td>'+group.group_name+'</td>';
            html += '<td>'+group.created_at+'</td>';
            html += '<td>';
            html += '<div id="tree_'+group.group_id+'">';
            html += 'Loading...';
            html += '</div>';
            html += '</td>';

            html += '<td>';
            html += '<a href="edit-group.php?group_id='+group.group_id+'" class="btn btn-warning btn-sm">';
            html += 'Edit';
            html += '</a>';
            html += '</td>';
            html += '</tr>';

        });

        $('#group_table').html(html);

        $.each(data, function(index, group){

            loadHierarchy(group.group_id);

        });

    });
}

function loadHierarchy(groupId)
{
    $.getJSON('./api/get-group.php?group_id='+groupId, function(data){

        var html = '';

        $.each(data, function(index, rule){

            var margin = (rule.tier - 1) * 25;
            html += '<div style="margin-left:'+margin+'px">';
            html += '|-- <strong>'+rule.rule_name+'</strong>';
            html += '<small class="text-muted">';
            html += ' ('+rule.rule_type+') - Tier '+rule.tier;
            html += '</small>';
            html += '</div>';

        });

        $('#tree_'+groupId).html(html);

    });
}

</script>

<?php include 'layout/footer.php'; ?>