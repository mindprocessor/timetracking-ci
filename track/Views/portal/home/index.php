<?php $this->extend('\Track\Views\layout\main'); ?>


<?php $this->section('content') ;?>

    <div class="container py-4">
        <?php echo session('fmsg'); ?>
        <div class="row">
            <div class="col">
                <div class="p-3 border rounded d-flex justify-content-between align-items-center">
                    <h3 class="m-0">Hi <?php echo current_user()->username; ?></h3>
                    <span>
                        <?php if($checking_status == 'out'): ?>
                            <a href="<?=base_url('/checkin');?>"
                                class="btn btn-primary"
                                up-follow>
                                Check-IN
                            </a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>

        <?php if($checking): ?>
        <div class="row mt-3">
            <div class="col">
                <div class="rounded p-3 border border-primary">
                    <div class="row g-3 checkin-record">
                        <div class="col">
                            <div>IN</div>
                            <div id="checkin-datetime" class="fw-bold lead">
                                <?=$checking['checkin'];?>
                            </div>
                        </div>
                        <div class="col">
                            <div>Time Elapsed</div>
                            <div class="time-elapsed fw-bold lead text-info">00:00</div>
                        </div>
                        <div class="col text-end">
                            <a href="<?=base_url("/checkout/id/{$checking['id']}");?>" 
                                class="btn btn-danger" up-follow>
                                Check-OUT    
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($checking):?>
            <div class="row mt-3 checkin-break-record">
                <div class="col-12">
                    <div class="p-3 border rounded-top">
                        <div class="mb-3">
                            <small>Breaks</small>
                        </div>
                        <?php foreach($break_choices as $break_choices): ?>
                            <a href="<?=base_url("/breakin/cid/{$checking['id']}/mode/{$break_choices}");?>" 
                                class="me-2 btn btn-light border btn-sm" up-follow>
                                <?=$break_choices;?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="border p-3 rounded-bottom">
                        <?php if($breaks): ?>
                        <table class="table">
                            <thead>
                                <th>Mode/Type</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Total Hours</th>
                                <th>Status</th>
                                <th></th>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach($breaks as $item): ?>
                                    <tr>
                                        <td><?=$item['mode'];?></td>
                                        <td>
                                            <?php if($item['status'] == 'start'): ?>
                                                <span id="break-time-start"><?= $item['start'];?></span>
                                            <?php else: ?>
                                                <?= $item['start']; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($item['status'] == 'start'): ?>
                                                <span class="bk-time-elapsed text-info fw-bold"></span>
                                            <?php else: ?>
                                                <?= $item['end']; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?=round($item['total_hours'], 2); ?></td>
                                        <td><?=$item['status']; ?></td>
                                        <td class="text-end">
                                            <?php if($item['status'] == 'start'): ?>
                                                <a href="<?=base_url("/breakout/id/{$item['id']}");?>" 
                                                    class='btn btn-sm btn-danger py-0' up-follow>
                                                    end
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>  
                </div>
            </div>
        <?php endif; ?>

    </div>

<?php $this->endSection();?>
