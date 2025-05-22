<!DOCTYPE html>
<?php $admin_language = $_SESSION['language'] ?? 'en';
if (!empty($_COOKIE['admin_language'])) {
    $admin_language = $_COOKIE['admin_language'];
} ?>
<!--[if IE 8]>
<html lang="<?= $admin_language ?>" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= $admin_language ?>">
<!--<![endif]-->

<head>
    <meta charset="utf-8"/>
    <title></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="WebSpirit Web Studio" name="author"/>

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,700,300,600,400&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="/assets/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet"/>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="/assets/font-awesome-5.15.1/css/all.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/style-admin/animate.min.css" rel="stylesheet"/>
    <link href="/assets/style-admin/style.min.css" rel="stylesheet"/>
    <link href="/assets/style-admin/style-responsive.min.css" rel="stylesheet"/>
    <link href="/assets/style-admin/theme/default.css" rel="stylesheet" id="theme"/>
    <link href="/assets/css/style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <!-- <link href="assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" /> -->
    <link href="/assets/gritter/css/jquery.gritter.css" rel="stylesheet"/>
    <link href="/assets/sweetalert2/sweetalert2.css" rel="stylesheet"/>
    <!-- <link href="assets/plugins/morris/morris.css" rel="stylesheet" /> -->
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body>


<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

    <?php include "@commons/header.php"; ?>

    <?php include "@commons/sidebar.php"; ?>

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <!-- end page-header -->

        <?php
        if (isset($_SESSION['notify']))
            require_once 'notify_view.php';
        echo $content;
        //        if (!empty($view_file))
//            require_once($view_file . '.php');
//        else
//            require_once('index_view.php');
        ?>

        <div id="saveing">
            <img src="/assets/style-admin/images/icon-loading.gif">
        </div>

    </div>
    <!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script type="text/javascript">
</script>
<script src="/assets/jquery-3.7.1.min.js"></script>
<script src="/assets/jquery-migrate-1.4.1.min.js"></script>
<script src="/assets/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/wl.js"></script>
<script src="/assets/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/gritter/js/jquery.gritter.js"></script>
<script src="/assets/sweetalert2/sweetalert2.js"></script>
<script src="/assets/color-admin/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script type="text/javascript">
    $(document).ready(function () {
        App.init();
        <?php if (!empty($_SESSION['alias']->js_init)) {
        foreach ($_SESSION['alias']->js_init as $js) {
            echo($js . ' ');
        }
    } ?>
    });
</script>

<script src="/assets/wl.js"></script>
<script>
    function test(){
        wl.ajax().then(
            function (response){

            }
        )
    }

    $('#TestForm').submit(function (){
        alert("hi");
    })
</script>

<script src="/assets/js/utils.js"></script>
<script src="/assets/js/ajaxProduct.js"></script>
<script src="/assets/js/productApp.js"></script>
<script src="/assets/js/ajaxUser.js"></script>
<script src="/assets/js/userApp.js"></script>

</body>

</html>