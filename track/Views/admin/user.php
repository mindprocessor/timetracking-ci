<?php $this->extend('\Track\Views\layout\admin'); ?>

<?php $this->section('content'); ?>
<div class="container py-4">
    <h3>Users / <?=$user['username'];?></h3>
    <?php echo session('fmsg'); ?>
    <div class="row g-3">
        <div class="col-12">
            <div class="p-3 border rounded bg-light d-flex justify-content-between">
                <span>
                    <a href="<?=base_url("admin/user-edit/id/{$user['id']}");?>" class="btn btn-primary">Edit details</a>
                    <a href="<?=base_url("admin/user-change-password/id/{$user['id']}");?>" class="btn btn-outline-primary">Change password</a>
                </span>
                <a href="<?=base_url("admin/user-delete/id/{$user['id']}");?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="p-3 rounded bg-primary bg-opacity-10">
                <small>EID</small>
                <div class="fs-4"><?=$user['eid'];?></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="p-3 rounded bg-primary bg-opacity-10">
                <small>Username</small>
                <div class="fs-4"><?=$user['username'];?></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="p-3 rounded bg-primary bg-opacity-10">
                <small>Full name</small>
                <div class="fs-4"><?=$user['first_name'];?> <?=$user['last_name'];?></div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 rounded bg-primary bg-opacity-10">
                <small>Level</small>
                <div class="fs-4"><?=$user['level'];?></div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 rounded bg-primary bg-opacity-10">
                <small>Account</small>
                <div class="fs-4"><?=$user['account'];?></div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 rounded bg-info bg-opacity-10">
                <small>Status</small>
                <div class="fs-4">
                    <?php if($user['status']): ?>
                        <span>ACTIVE</span>
                        <a href="<?=base_url('admin/user-deactivate/id/'.$user['id']);?>" 
                            class="btn btn-sm btn-dark float-end">
                            deactivate
                        </a>
                    <?php else: ?>
                        <span>DEACTIVATED</span>
                        <a href="<?=base_url('admin/user-activate/id/'.$user['id']);?>" 
                            class="btn btn-sm btn-success float-end">
                            activate
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="p-3 rounded bg-light">

                <h5>Timelogs</h5>

                <form action="post" role="form" class="mt-4" 
                    hx-post="<?=base_url('admin/htmx/filter/timelog');?>"
                    hx-target="#timelog-records">
                    <?php echo csrf_field();?>
                    <input type="hidden" name="user_id" readonly value="<?=$user['id'];?>">
                    <div class="row">
                        <div class="col-4">
                            <input type="month" name="month" class="form-control">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-dark">
                                Filter
                            </button>
                        </div>
                        <div class="col text-end htmx-indicator">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="timelog-records" class="mt-3">
                    <small>Recent Attendance</small>

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
                    <?php endif; ?>
                </div>
            
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

<?php $this->section('bottomtags');?>
<script type="text/javascript">
    $(document).on('click', '.btn-timesheet-detail', function(e){
        e.preventDefault();
        $('#timesheet-detail').html('Loading content...');
        target_url = $(this).attr('target-url');
        $('#modal-timesheet').modal('show');
        htmx.ajax('get', target_url, '#timesheet-detail');
    });
</script>
<?php $this->endSection(); ?>