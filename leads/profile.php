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
                <a class="nav-link" id="pan-tab" data-toggle="tab" href="#activities" role="tab" aria-controls="pan"
                    aria-selected="false">Activites</a>
            </li>
        </ul>
        <br />
        <div class="tab-content profile-tab" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Profile Details</h3>
                <hr />
                <br />
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
                <br />
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
                <br />
                <div class="row">
                    <div class="col">
                        <h6 class="title">Location</h6>

                        <h4 class="title_value" id="location"></h4>
                    </div>
                    <div class="col">
                        <h6 class="title">Lead Status</h6>

                        <h4 class="title_value"><span class="badge badge-primary" id="lead_status"></span></h4>
                    </div>
                </div>
                <br />
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
                <br />
                <div class="row">
                    <div class="col">
                        <h6 class="title">Lead Owner</h6>

                        <h4 class="title_value" id="lead_owner"></h4>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="activities" role="tabpanel" aria-labelledby="targets-tab">
                <h3>Activities</h3>
                <hr />
                <div id="cardContainer" class="cardContainer"></div>
                <div id="blankDiv">
                    <h3>No activities available for this lead</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let id = '<?php echo $_GET['id']; ?>';
const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct",
    "Nov", "Dec"
];


function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

$(document).ready(function() {
    $.ajax({
        url: baseUrl + '/lead_details/' + id,
        type: 'get',
        headers: {
            'Authorization': "Bearer " + token
        },
        success: function(data) {
            if (data.status === 1) {
                let leadDetails = data.details;
                console.log(leadDetails);
                $('#profile_name').html(leadDetails.first_name + ' ' + leadDetails.last_name);
                $('#first_name').html(leadDetails.first_name);
                $('#last_name').html(leadDetails.last_name);
                $('#email').html(leadDetails.email);
                $('#contact').html(leadDetails.contact);
                $('#location').html(leadDetails.location);
                $('#account_category').html(leadDetails.account_category);
                $('#account_code').html(leadDetails.account_code);
                $('#lead_status').html(leadDetails.lead_status);
                $('#lead_owner').html(leadDetails.owner_first_name + ' ' + leadDetails
                    .owner_last_name);
            }
        },
        error: function(errorData) {}
    });
    $.ajax({
        url: baseUrl + '/lead_activities/' + id,
        type: 'get',
        headers: {
            'Authorization': "Bearer " + token
        },
        success: function(data) {
            if (data.status === 0) {
                $('#cardContainer').css('display', 'none');
                $('#blankDiv').css('display', 'block');
            } else {
                let activities = data.details;
                console.log(activities);
                $('#cardContainer').css('display', 'block');
                $('#blankDiv').css('display', 'none');
                for (var i = 0; i < activities.length; i++) {
                    var d = new Date(activities[i].created_at);
                    var dater = d.getDate() + '-' + months[d.getMonth()] + '-' + d.getFullYear() +
                        ' ' + formatAMPM(d);
                    $('#cardContainer').append('<div class="card"><div class="card-header">' +
                        activities[i].activity_type +
                        '</div><div class="card-body"><h5 class="card-title">' + activities[i]
                        .activity_log +
                        '</h5><p class="card-text">' + dater +
                        '</p> </div></div><br/>'
                    );
                }
            }
        }
    });
});
</script>
<?php
	include '../includes/footer.php';
}
?>