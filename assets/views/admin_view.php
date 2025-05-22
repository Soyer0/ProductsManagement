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
	<title><?= !empty($_SESSION['alias']->title) ? $_SESSION['alias']->title : strip_tags($_SESSION['alias']->name) ?> | <?= $this->__('Admin panel') ?> <?= SITE_NAME ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
	<meta content="WebSpirit Web Studio" name="author"/>

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,700,300,600,400&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link href="<?= SERVER_URL ?>assets/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet"/>
	<link href="<?= SERVER_URL ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="<?= SERVER_URL ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
	<link href="<?= SERVER_URL ?>assets/font-awesome-5.15.1/css/all.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= SERVER_URL ?>style/admin/animate.min.css" rel="stylesheet"/>
	<link href="<?= SERVER_URL ?>style/admin/style.min.css" rel="stylesheet"/>
	<link href="<?= SERVER_URL ?>style/admin/style-responsive.min.css" rel="stylesheet"/>
	<link href="<?= SERVER_URL ?>style/admin/theme/default.css" rel="stylesheet" id="theme"/>
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<!-- <link href="assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" /> -->
	<link href="<?= SERVER_URL ?>assets/gritter/css/jquery.gritter.css" rel="stylesheet"/>
	<link href="<?= SERVER_URL ?>assets/sweetalert2/sweetalert2.css" rel="stylesheet"/>
	<!-- <link href="assets/plugins/morris/morris.css" rel="stylesheet" /> -->
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?= SERVER_URL ?>assets/pace/pace.min.js"></script>
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
		<ol class="breadcrumb pull-right">
			<li><a href="<?= SITE_URL ?>admin"><i class="fas fa-laptop"></i> <?= $this->__('Dashboard') ?></a></li>
			<?php if ($_SESSION['alias']->breadcrumbs) {
				$end_link = end($_SESSION['alias']->breadcrumbs);
				foreach ($_SESSION['alias']->breadcrumbs as $name => $link) {
					if ($link == '' || $link == $end_link)
						echo('<li class="active">' . $name . '</li>');
					else echo('<li><a href="' . SITE_URL . $link . '">' . $name . '</a></li>');
				}
			} ?>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header"><?= $_SESSION['alias']->admin_ico . $_SESSION['alias']->name ?></h1>
		<!-- end page-header -->

		<?php
		if (isset($_SESSION['notify']))
			require_once 'notify_view.php';
		if (!empty($view_file))
			require_once($view_file . '.php');
		else
			require_once('index_view.php');
		?>

		<div id="saveing">
			<img src="<?= SERVER_URL ?>style/admin/images/icon-loading.gif">
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
    var SITE_URL = '<?= SITE_URL ?>';
    var ALIAS_URL = '<?= SITE_URL . $_SESSION['alias']->alias . '/' ?>';
    var ALIAS_ADMIN_URL = '<?= SITE_URL . 'admin/' . $_SESSION['alias']->alias . '/' ?>';
    var ADMIN_URL = '<?= SITE_URL . 'admin/' ?>';
    let __ = {
        <?php foreach ([
                'Error!',
                'Changes saved!',
                'Data saved successfully!',
                'Error! Try again!',
                'Error: Timed out! Try again!',
                'Section deleted!',
                'All media data in the section has been deleted',
                "Are you sure you want to change the image format to ",
                "Are you sure you want to delete the photo? WARNING, the information is NOT recoverable!",
                "Are you sure you want to delete the mobile version of the photo? WARNING, the information is NOT recoverable!"
            ] as $_i18n) {
                $_i18n_value = $this->__($_i18n);
                echo "'{$_i18n}': '{$_i18n_value}',\n";
        } ?>
    };
</script>
<script src="<?= SERVER_URL ?>assets/jquery/jquery-3.7.1.min.js"></script>
<script src="<?= SERVER_URL ?>assets/jquery/jquery-migrate-1.4.1.min.js"></script>
<script src="<?= SERVER_URL ?>assets/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?= SERVER_URL ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= SERVER_URL ?>assets/wl.js"></script>
<script src="<?= SERVER_URL ?>assets/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= SERVER_URL ?>assets/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?= SERVER_URL ?>assets/gritter/js/jquery.gritter.js"></script>
<script src="<?= SERVER_URL ?>assets/sweetalert2/sweetalert2.js"></script>
<?php if (!empty($_SESSION['alias']->js_load)) {
	foreach ($_SESSION['alias']->js_load as $js) { ?>
		<script src="<?= SERVER_URL . $js ?>"></script>
	<?php }
} ?>
<script src="<?= SERVER_URL ?>assets/color-admin/apps.min.js"></script>
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
</body>

</html>