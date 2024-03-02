<table class="mt-3 table table-hover">
    <thead>
        <th>IN</th>
        <th>OUT</th>
        <th>Total Hours</th>
        <th></th>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach($timelogs as $log): ?>
            <tr>
                <td><?=$log['checkin'];?></td>
                <td><?=$log['checkout'];?></td>
                <td><?=round($log['total_hours'], 2);?></td>
                <td>
                    <a href="<?=base_url("/timelog-details/id/{$log['id']}");?>" 
                        class="btn btn-sm btn-light border py-0">
                        details
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>