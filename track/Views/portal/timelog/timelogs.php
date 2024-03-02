<?php $this->extend('\Track\Views\layout\main'); ?>

<?php $this->section('content'); ?>
<div class="container py-4">
    <h3>Recent Timelogs</h3>
    <div class="row mt-3">
        <div class="col">
            <div class="table-responsive p-3 rounded border">
                <form method="post" up-submit>
                    <?=csrf_field();?>
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <input type="month" name="month" class="form-control" value="<?=$month;?>">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-light border">Filter</button>
                        </div>
                    </div>
                </form>
                <div id="filter-results">
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
                                        <a href="<?=base_url("/timelog/id/{$log['id']}");?>" 
                                            class="btn btn-sm btn-light border py-0"
                                            up-layer="new" up-size="large">
                                            details
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection();?>