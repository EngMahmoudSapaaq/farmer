<div class="card-body text-end">
    <h5 class="card-title">
        <div class="row">
            <div class="col card bg-secondary text-light">
                <div class="card-body">
                    <p class="text-start m-0"><?= $msg->message ?></p>
                </div>
            </div>
            
            <div class="col-2 text-center my-auto">
                <img src="<?= '../../assets/uploads/' . $other->image ?>"
                    onerror="this.src = 'https://d2gtafdivcal5l.cloudfront.net/images/profile-placeholder-img_20210727172702.png'"
                    width="50" height="50"
                    style="object-fit: cover;"
                    class="rounded-circle me-2">
                <div class="mt-2">
                    <small class="text-muted fs-6 text-nowrap"><?= date("d-m-Y", strtotime($msg->created_at)) ?></small>
                    <small class="text-muted fs-6 text-nowrap"><?= date("H:i:s", strtotime($msg->created_at)) ?></small>
                </div>
            </div>
        </div>
    </h5>
</div>