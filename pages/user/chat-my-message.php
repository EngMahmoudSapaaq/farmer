<div class="card-body">
    <h5 class="card-title">
        <div class="row">
            <div class="col-2 text-center my-auto">
                <div class="mt-2">
                    <small class="text-muted fs-6 text-nowrap"><?= date("d-m-Y", strtotime($msg->created_at)) ?></small>
                    <small class="text-muted fs-6 text-nowrap"><?= date("H:i:s", strtotime($msg->created_at)) ?></small>
                </div>
            </div>
            <div class="col card bg-primary text-light">
                <div class="card-body">
                    <p class="m-0"><?= $msg->message ?></p>
                </div>
            </div>
        </div>
    </h5>
</div>