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
    </div>
</div>

<script>
var id = '<?php echo $_GET['id']; ?>';
$(document).ready(function() {
    $.ajax({
        url: baseUrl + '/user_details/' + id,
        type: 'get',
        headers: {
            'Authorization': "Bearer " + token
        },
        success: function(data) {},
        error: function(errorData) {}
    });
});
</script>
<?php
	include '../includes/footer.php';
}
?>