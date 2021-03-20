<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $header_title ?></title>
    <?= $this->include('admin/partials/part-css') ?>
    <?= $this->include('admin/partials/gtags-manager') ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?= $this->include('admin/partials/navbar') ?>
            <?= $this->include('admin/partials/sidebar') ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <?= $this->include('admin/partials/header') ?>

                    <div class="section-body">
                        <h2 class="section-title"><?= $badges ?></h2>
                        <p class="section-lead">
                            <?= $desc_badges ?>
                        </p>
                        <?= $this->renderSection('layouts-contents'); ?>
                    </div>
                </section>
                <?= $this->renderSection('modal'); ?>
            </div>
            <?= $this->include('admin/partials/footer') ?>
        </div>
    </div>
    <?= $this->include('admin/partials/part-js') ?>
</body>

</html>