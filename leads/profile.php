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
        <hr/>
        <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pan-tab" data-toggle="tab" href="#targets" role="tab" aria-controls="pan" aria-selected="false">Targets</a>
            </li>
        </ul>
    <br/>
    <div class="tab-content profile-tab" id="myTabContent">
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">                <h3>Profile Details</h3>
            <br/>
            <div class="row">
                <div class="col">
                    <h6 class="title">First Name</h6>
                    <h4 class="title_value" id="first_name"></h4>
                </div>
                <div class="col">
                    <h6 class="title">Last Name</h6>
                    <h4 class="title_value" id="last_name"></h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="title">Phone</h6>
                    <h4 class="title_value" id="phone"></h4>
                </div>
                <div class="col">
                    <h6 class="title">Email</h6>
                    <h4 class="title_value" id="email"></h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="title">Location</h6>
                    <h4 class="title_value" id="location"></h4>
                </div>
                <div class="col">
                    <h6 class="title">Lead Status</h6>
                    <h4 class="title_value_badge" id="lead_status"></h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="title">Account Category</h6>
                    <h4 class="title_value" id="account_category"></h4>
                </div>
                <div class="col">
                    <h6 class="title">Account Code</h6>
                    <h4 class="title_value" id="account_code"></h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="title">Third Party</h6>
                    <h4 class="title_value" id="third_party"></h4>
                </div>
                <div class="col">
                    <h6 class="title">Stock Margin</h6>
                    <h4 class="title_value" id="stock_margin"></h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="title">Lead Owner</h6>
                    <h4 class="title_value" id="lead_owner"></h4>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="targets" role="tabpanel" aria-labelledby="targets-tab">
                <h3>Target Details</h3>
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
            if( data.status === 1 ) {
                let userDetails = data.details;
                console.log(userDetails.first_name);
                $('#profile_name').html(userDetails.first_name+' '+userDetails.last_name);
                $('#first_name').html(userDetails.first_name);
                $('#last_name').html(userDetails.last_name);
                $('#email').html(userDetails.email);
                $('#contact').html(userDetails.contact);
                $('#location').html(userDetails.location);
                $('#account_category').html(userDetails.account_category);
                $('#account_code').html(userDetails.account_code);
                $('#lead_status').html(userDetails.lead_status);
                $('#lead_owner').html(userDetails.lead_owner);
            }
        },
        error: function(errorData) {}
    });
});
</script>
<?php
	include '../includes/footer.php';
}
?>