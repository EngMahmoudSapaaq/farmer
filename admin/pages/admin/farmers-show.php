<?php
    require_once __DIR__ . "/../../../vendor/autoload.php";

    use Core\Helpers\Redirect;

    Redirect::ifNotLoggedIn();
    Redirect::ifNotAdmin();
?>

<!-- Modal -->
<div class="modal fade" id="showFarmerDataModal<?= $farmer->id ?>" tabindex="-1" aria-labelledby="showFarmerDataModal<?= $farmer->id ?>Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showFarmerDataModal<?= $farmer->id ?>Label">View Farmer Data</h5>
            </div>

            <div class="modal-body">
                <table class="table table-striped" style="width:100%; text-align: left;">
                    <thead>
                        <tr class="text-center">
                            <td colspan="2">
                                <img src="<?= '../../../assets/uploads/' . $farmer->image ?>"
                                    onerror="this.src = 'https://d2gtafdivcal5l.cloudfront.net/images/profile-placeholder-img_20210727172702.png'"
                                    alt="" class="img-fluid rounded-circle border border-dark"
                                    style="width: 300px; height: 300px; object-fit: cover;">
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td><?= $farmer->name ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $farmer->email ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td><?= $farmer->phone ?></td>
                        </tr>
                        <tr>
                            <th>Commercial Register</th>
                            <td><?= $farmer->commercial_number ?></td>
                        </tr>
                        <tr>
                            <th>Rating</th>
                            <td><span class="my-rating-read-only" data-rating="<?= $farmer->getRating() ?>" dir="ltr"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>