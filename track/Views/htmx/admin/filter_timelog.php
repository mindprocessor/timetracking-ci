<?php if($timelogs): ?>

<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>IN</th>
            <th>OUT</th>
            <th>Hours</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach($timelogs as $log): ?>
            <tr>
                <td><?=$log['checkin'];?></td>
                <td><?=$log['checkout'];?></td>
                <td><?=$log['total_hours'];?></td>
                <td>
                    <a href="#" 
                        target-url="<?=base_url("admin/htmx/timesheet/{$log['id']}");?>"
                        class="text-decoration-none fw-bold btn-timesheet-detail">
                        details
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p class="lead">No records found</p>
<?php endif; ?>