<?php $this->extend('\Track\Views\layout\admin'); ?>

<?php $this->section('content'); ?>
<div class="container py-4">
    <h3>Recent Timelogs</h3>
    <div class="row mt-3">
        <div class="col">
            <div class="table-responsive p-3 rounded border">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>EID</th>
                            <th>Username</th>
                            <th>IN</th>
                            <th>OUT</th>
                            <th>Total Hours</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach($timelogs as $log): ?>
                            <tr>
                                <td><?=$employee_id[$log['users_id']] ?? '--';?></td>
                                <td>
                                    <a href="<?=base_url("admin/user/id/{$log['users_id']}");?>" class="text-decoration-none fw-bold">
                                        <?=$username[$log['users_id']] ?? null;?>
                                    </a>
                                </td>
                                <td><?=$log['checkin'];?></td>
                                <td><?=$log['checkout'];?></td>
                                <td><?=round($log['total_hours'], 2);?></td>
                                <td>
                                    <button target-url="<?=base_url("admin/htmx/timesheet/{$log['id']}");?>"
                                        class="btn btn-sm btn-light border py-0 btn-timesheet-detail">
                                        details
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modal-timesheet">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="timesheet-detail">Loading content...</div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection();?>


<?php $this->section('bottomtags'); ?>
    <script type="text/javascript">
        $('.btn-timesheet-detail').on('click', function(){
            $('#timesheet-detail').html('Loading content...');
            target_url = $(this).attr('target-url');
            $('#modal-timesheet').modal('show');
            htmx.ajax('get', target_url, '#timesheet-detail');
        });
    </script>
<?php $this->endSection();?>