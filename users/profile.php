<?php

session_start();

if( !isset($_SESSION['token']) ) {
	header("Location: ../");
} else {
	?>
<?php include '../includes/header.php' ?>
<title>Users Profile | Triventure Sales </title>
<?php include '../includes/sidebar.php'; ?>
<div id="main" class="p-3">
    <div class="containerBox">
        <h2 id="profile_name"></h2>
        <hr />
        <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="home" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pan-tab" data-toggle="tab" href="#targets" role="tab" aria-controls="pan"
                    aria-selected="false">Targets</a>
            </li>
        </ul>
        <br />
        <div class="tab-content profile-tab" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Profile Details</h3>
                <hr />
                <div class="row">
                    <div class="col">
                        <h6 class="title">First Name</h6>
                        <hr />
                        <h4 class="title_value" id="first_name"></h4>
                    </div>
                    <div class="col">
                        <h6 class="title">Last Name</h6>
                        <hr />
                        <h4 class="title_value" id="last_name"></h4>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col">
                        <h6 class="title">Phone</h6>
                        <hr />
                        <h4 class="title_value" id="phone"></h4>
                    </div>
                    <div class="col">
                        <h6 class="title">Email</h6>
                        <hr />
                        <h4 class="title_value_smallcase" id="email"></h4>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="targets" role="tabpanel" aria-labelledby="targets-tab">
                <h3>Target Details</h3>
                <hr />
                <!-- Button trigger modal -->
                <a class="edit_link" data-toggle="modal" data-target="#targetModal">
                    Edit This Month Target
                </a>
                <br />
                <table class="display table hover" width="100%" id="targetTable">
                    <thead>
                        <tr>
                            <th>Month - Year</th>
                            <th>Type</th>
                            <th>Achieved</th>
                            <th>Target</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="targetModal" tabindex="-1" aria-labelledby="targetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="targetModalLabel">Edit Target</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateTarget">
                        <div class="form-group">
                            <label for="monthyear">Month Year</label>
                            <p> <?php echo date('M - Y'); ?> </p>
                            <input type="hidden" name="user_id" value="<?php echo $_GET['id']; ?>">
                            <input type="hidden" name="month" value="<?php echo date('n'); ?>">
                            <input type="hidden" name="year" value="<?php echo date('Y'); ?>">
                        </div>
                        <h6>Targets</h6>
                        <hr />
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">New
                                Leads:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="new">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Existing
                                Leads:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="existing">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm"
                                class="col-sm-2 col-form-label col-form-label-sm">Account:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="account">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm"
                                class="col-sm-2 col-form-label col-form-label-sm">Margin:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="margin">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mutual
                                Funds:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mutual_funds">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm"
                                class="col-sm-2 col-form-label col-form-label-sm">Insurance:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="insurance">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Third
                                party:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="third_party">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="save_targets" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let id = '<?php echo $_GET['id']; ?>';
$(document).ready(function() {
    $.ajax({
        url: baseUrl + '/user_details/' + id,
        type: 'get',
        headers: {
            'Authorization': "Bearer " + token
        },
        success: function(data) {
            if (data.status === 1) {
                let userDetails = data.details;
                $('#profile_name').html(userDetails.first_name + ' ' + userDetails.last_name);
                $('#first_name').html(userDetails.first_name);
                $('#last_name').html(userDetails.last_name);
                $('#email').html(userDetails.email);
                $('#contact').html(userDetails.contact);
            }
        },
        error: function(errorData) {}
    });

    var table = $('#targetTable').DataTable({
        "scrollX": true,
        "ajax": {
            url: baseUrl + "/user_targets_table/" + id,
            headers: {
                'Authorization': "Bearer " + token
            },
        },
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    $('#save_targets').on('click', () => {
        let inputData = $("#updateTarget").serialize();
        console.log(inputData);
        $.ajax({
            url: baseUrl + '/set_user_targets',
            type: 'post',
            headers: {
                'Authorization': "Bearer " + token
            },
            data: inputData,
        }).done(function(response) {
            console.log('Successful hit!');
            console.log(response);
        })
    });

});
</script>
<?php
	include '../includes/footer.php';
}
?>