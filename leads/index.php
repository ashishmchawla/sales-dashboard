<?php 

session_start();

if( !isset($_SESSION['token']) ) {
	header("Location: ../");
} else {
	?>
<?php include '../includes/header.php' ?>
<title>Leads | Triventure Sales </title>
<?php include '../includes/sidebar.php'; ?>
<div id="main" class="p-3">
    <div class="containerBox">
        <table class="display table hover" width="100%" id="leadsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th>Lead Owner</th>
                    <th>Lead Status</th>
                    <th>Created On</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {

    var table = $('#leadsTable').DataTable({
        "scrollX": true,
        "ajax": {
            url: baseUrl + "/allLeads",
            headers: {
                'Authorization': "Bearer " + token
            },
        },
        "order": [
            [7, 'desc']
        ]
    })

    $('#leadsTable tbody').on('click', 'tr', function() {
        var tableData = table.row(this).data();
        window.location.href = "./profile.php?id=" + tableData[0];
    });
});
</script>
<?php
	include '../includes/footer.php'; 
}
?>