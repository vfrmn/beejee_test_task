<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tasks BeeJee</title>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/assets/css/style.css" rel="stylesheet"/>
    <link href="/assets/font_awesome/css/all.min.css" rel="stylesheet"/>
</head>
<body>
<header class="blog-header py-3 bg-secondary w-100">
    <div class="row flex-nowrap w-100 justify-content-between m-0 align-items-center">
        <div class="col-6 text-left">
            <a class="blog-header-logo text-dark h3" href="<?= url('/') ?>">Tasks</a>
        </div>
        <?php if ($is_logged_in): ?>
            <a class=" ml-3 btn btn-sm btn-outline-secondary text-dark h2 border-success bg-white mr-3"
               href="<?= url('?controller=LoginController&action=logout&direction=' . $direction . '&order_by=' . $order_by . '&page=' . $page) ?>">Logout
                <i class="fa fa-lg fa-sign-out-alt cursor-pointer"></i></a>

        <?php else: ?>
            <div class="col-6 d-flex text-right justify-content-end align-items-center">
                <a class="btn btn-sm btn-outline-secondary text-dark h2 border-success bg-white"
                   href="<?= url('?controller=LoginController&action=index&direction=' . $direction . '&order_by=' . $order_by . '&page=' . $page) ?>">Sign
                    in
                    <i class="fa fa-lg fa-sign-in-alt cursor-pointer"></i></a>
            </div>
        <?php endif; ?>
    </div>
</header>