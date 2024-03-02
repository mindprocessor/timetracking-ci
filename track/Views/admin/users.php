<?php $this->extend('\Track\Views\layout\admin'); ?>

<?php $this->section('content'); ?>
<div class="container py-4">
    <h3>Users</h3>
    <div class="row">
        <div class="col">
            <?php echo session('fmsg'); ?>
            <div class="table-responsive p-3 rounded border">
                <div class="text-end">
                    <a  href="<?=base_url('admin/user-add');?>" class="btn btn-primary">
                        New User
                    </a>
                </div>
                <table class="mt-3 table table-hover">
                    <thead>
                        <tr>
                        <th>EID</th>
                        <th>Username</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Level</th>
                        <th>Account</th>
                        <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td><?=$user['eid'];?></td>
                                <td>
                                    <a href="<?=base_url("admin/user/id/{$user['id']}");?>" 
                                        class="text-decoration-none fw-bold">
                                        <?=$user['username'];?>
                                    </a>
                                </td>
                                <td><?=$user['first_name'];?></td>
                                <td><?=$user['last_name'];?></td>
                                <td><?=$user['level'];?></td>
                                <td><?=$user['account'];?></td>
                                <td>
                                    <?php if($user['status']): ?>
                                        <span class="text-success fw-bold">active</span>
                                    <?php else: ?>
                                        <span class="text-danger fw-bold">inactive</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection();?>