<?php include 'layout/header.php'; ?>

<div class="container mt-5 mb-5">

    <h2 class="mb-4">Create Group</h2>

    <div class="card p-4">

        <div class="mb-3">
            <label class="form-label">Group Name</label>
            <input type="text" id="group_name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Select Rule</label>
            <select id="rule_id" class="form-control">
                <option value="">Select Rule</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Parent Rule</label>
            <select id="parent_rule_id" class="form-control">
                <option value="">Root Rule</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tier</label>
            <select id="tier" class="form-control">
                <option value="1">Tier 1</option>
                <option value="2">Tier 2</option>
                <option value="3">Tier 3</option>
            </select>
        </div>

        <button id="add_rule" class="btn btn-success mb-3">
            Add Rule
        </button>

        <div id="assigned_box" class="card p-3 mb-3" style="display:none;">
            <h5>Assigned Rules</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Rule</th>
                        <th>Type</th>
                        <th>Parent</th>
                        <th>Tier</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="assigned_rules_table"></tbody>
            </table>
        </div>

        <button id="save_group" class="btn btn-primary w-100">
            Save Group
        </button>

    </div>

</div>

<script src="public/app.js"></script>

<?php include 'layout/footer.php'; ?>