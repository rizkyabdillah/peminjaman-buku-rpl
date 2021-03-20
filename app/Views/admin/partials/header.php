<div class="section-header">
    <?php if (empty($link_back) ?  false : true) { ?>
        <div class="section-header-back">
            <a href="<?= route_to($link_back) ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
    <?php } ?>
    <h1><?= $header_title ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?= $link_breadcrumb ?>"><?= $header_title ?></a></div>
        <?php if ($is_show_badge3) { ?>
            <div class="breadcrumb-item"><?= $badge_3 ?></div>
        <?php } ?>
    </div>
</div>