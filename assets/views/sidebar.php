<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
<div data-scrollbar="true" data-height="100%">
<ul class="nav">
    <li class="nav-profile">
        <div class="image">
            <a href="<?=SITE_URL?>admin/wl_users/my"><img src="<?=SITE_URL?>style/admin/images/user-<?= $_SESSION['user']->type_id ?? 1 ?>.jpg" alt="<?= $_SESSION['user']->name ?>" /></a>
        </div>
        <div class="info">
            <?= $_SESSION['user']->name ?? '' ?>
            <small><?= $_SESSION['user']->type_title ?? '' ?></small>
        </div>
    </li>
</ul>
<ul class="nav">
    <li class="nav-header"><?= $this->__('Navigation') ?>:</li>
    <li <?=($_SESSION['alias']->alias == 'admin')?'class="active"':''?>>
        <a href="<?=SITE_URL?>admin">
            <i class="fas fa-laptop"></i>
            <span><?= $this->__('Dashboard') ?></span>
        </a>
    </li>

    <!-- begin sidebar minify button -->
    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
    <!-- end sidebar minify button -->
</ul>
<!-- end sidebar nav -->
</div>
<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->