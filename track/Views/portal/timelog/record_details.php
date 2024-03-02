<?php $this->extend('\Track\Views\layout\main'); ?>


<?php $this->section('content'); ?>
<div class="container py-4">

    <h3 class="mt-3">Timesheet Details</h3>

    <div class="row mt-3">
        <div class="col">
            <div class="p-3 rounded border">
                <div class="row g-3">
                    <div class="col">
                        <div class="p-3 bg-primary bg-opacity-10 rounded">
                            <div>Working Hours:</div> 
                            <div class="fw-bold lead">
                                <?php echo round( ($checking['total_hours'] - $breaks_total_hours) , 2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-info bg-opacity-10 rounded">
                            <div>Break Hours:</div> 
                            <div class="fw-bold lead">
                                <?=round($breaks_total_hours, 2); ?>
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
                                <?=$checking['checkin'];?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-info bg-opacity-10 rounded">
                            <div>OUT:</div> 
                            <div class="fw-bold lead">
                                <?=$checking['checkout'];?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-info bg-opacity-10 rounded">
                            <div>Status:</div> 
                            <div class="fw-bold lead">
                               <?=$checking['status'];?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-info bg-opacity-10 rounded">
                            <div>Hours:</div> 
                            <div class="fw-bold lead">
                                <?=round($checking['total_hours'],2);?>
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
                                <td><?=$item['end'];?></td>
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
                    <?=trim($checking['eod']);?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $this->endSection(); ?>