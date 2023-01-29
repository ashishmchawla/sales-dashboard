<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Font Awesome! -->
    <script src="https://kit.fontawesome.com/bb027a9024.js" crossorigin="anonymous"></script>

    <!-- Uppy CSS -->
    <link href="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/favicon.png" />
    <meta name="theme-color" content="#0f1e32" />

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/date-dd-MMM-yyyy.js">
    </script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/r-2.2.1/sc-1.4.4/datatables.min.js"
        defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css">
    <script src="https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.min.js"></script>

    <!-- DatePickers -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Moment -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Profile CSS -->
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="manifest" href="../manifest.json">
    <script src="../sw.js"></script>
    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
    var token = "<?php echo $_SESSION['token']?>";
    var baseUrl = '<?php echo $_SESSION['base_url']; ?>';
    window.addEventListener("load", (e) => {
        registerSW();
    });
    </script>