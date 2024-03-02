<?php $this->extend('\Track\Views\layout\admin'); ?>

<?php $this->section('content'); ?>
<div class="container py-4">
    <div class="row">
        <div class="col">
            <h3>Reports <span class="fs-6">(Incident logs)</span></h3>
        </div>
        <div class="col text-end">
            <span class="btn-group">
                <a href="?resolved=no" class="btn btn-light border" up-follow>Unresolved</a>
                <a href="?resolved=yes" class="btn btn-light border" up-follow>Resolved</a>
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <?php if($reports > 0): ?>
                    <table class="table">
                        <thead>
                            <th>Severity</th>
                            <th>Title</th>
                            <th>Submitted by</th>
                            <th>Datetime</th>
                            <th>Status</th>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach($reports as $report): ?>
                                <tr>
                                    <td><?=$report['severity'];?></td>
                                    <td>
                                        <a href="<?=base_url("admin/reports/record/id/{$report['id']}");?>" 
                                            class="text-decoration-none fw-bold"
                                            up-layer="new" up-size="large" up-on-dismissed="up.reload()" up-scroll="restore">
                                            <?=$report['title'];?></td>
                                        </a>
                                    <td><?=$usernames[$report['users_id']];?></td>
                                    <td><?=$report['created'];?></td>
                                    <td><?= ($report['resolved']==true) ? 'resolved' : 'unresolved'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No records listed</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection();?>