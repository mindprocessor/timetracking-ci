
<div>

    <h3>Timesheet Details</h3>

    <div class="row g-3">
        <div class="col-6">
            <div class="p-3 rounded border">
                <small>Username</small>
                <div class="fw-bold"><?=$user['username'];?></div>
            </div>
        </div>
        <div class="col-6">
            <div class="p-3 rounded border">
                <small>Name</small>
                <div><?=$user['first_name'].' '.$user['last_name'];?></div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 rounded border">
                <div class="row g-3">
                    <div class="col">
                        <div class="p-3 bg-primary bg-opacity-10 rounded">
                            <div>Working Hours:</div> 
                            <div class="fw-bold lead">
                                <?php echo round( ($timesheet['total_hours'] - $total_break_hours) , 2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-info bg-opacity-10 rounded">
                            <div>Break Hours:</div> 
                            <div class="fw-bold lead">
                                <?=round($total_break_hours, 2); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="p-3 border rounded">
                <h5>Timelog</h5>

                <div class="row g-3 mt-2">
                    <div class="col">
                        <div class="p-3 bg-primary bg-opacity-10 rounded">
                            <div>IN:</div> 
                            <div class="fw-bold lead">
                                <?=$timesheet['checkin'];?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-info bg-opacity-10 rounded">
                            <div>OUT:</div> 
                            <div class="fw-bold lead">
                                <?php if($timesheet['status'] == 'out'): ?>
                                    <?=$timesheet['checkout'];?>
                                <?php else: ?>
                                    <span>00:00</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-info bg-opacity-10 rounded">
                            <div>Status:</div> 
                            <div class="fw-bold lead">
                               <?=$timesheet['status'];?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-info bg-opacity-10 rounded">
                            <div>Hours:</div> 
                            <div class="fw-bold lead">
                                <?=round($timesheet['total_hours'],2);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="p-3 rounded border">
                <h5>Breaks</h5>
                <?php if(count($breaks) > 0): ?>
                <table class="table">
                    <thead>
                        <th>Mode</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Hours</th>
                        <th>Status</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach($breaks as $item): ?>
                            <tr>
                                <td><?=$item['mode'];?></td>
                                <td><?=$item['start'];?></td>
                                <td>
                                    <?php if($item['status']=='start'): ?>
                                        <span>00:00</span>
                                    <?php else: ?>
                                        <?=$item['end'];?>
                                    <?php endif;?>
                                </td>
                                <td><?=round($item['total_hours'],2);?></td>
                                <td><?=$item['status'];?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <em>No records found</em>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="p-3 border rounded">
                <h5>End of day report</h5>

                <div class="" style="white-space: pre-line;">
                    <?=trim($timesheet['eod']);?>
                </div>
            </div>
        </div>
    </div>

</div>
