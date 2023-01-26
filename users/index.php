<?php 

session_start();

if( !isset($_SESSION['token']) ) {
	header("Location: ../");
} else {
	?>
<?php include '../includes/header.php' ?>
<title>Users | Triventure Sales </title>
<?php include '../includes/sidebar.php'; ?>
<div id="main" class="p-3">
    <div class="containerBox">
        <table class="display table hover" width="100%" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>User Type</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {

    var table = $('#usersTable').DataTable({
        "scrollX": true,
        "ajax": {
            url: baseUrl + "/allUsers",
            headers: {
                'Authorization': "Bearer " + token
            },
        },
    })

    $('#usersTable tbody').on('click', 'tr', function() {
        var tableData = table.row(this).data();
        window.location.href = "./profile.php?id=" + tableData[0];
    });
});
</script>
<?php
	include '../includes/footer.php'; 
}
?>