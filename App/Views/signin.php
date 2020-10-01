<div class="wrapper text-center ">
    <form class="form-signin w-50 mx-auto mt-5" method="post"
          action="<?= url('?controller=LoginController&action=login&direction=' . $direction . '&order_by=' . $order_by . '&page=' . $page) ?>">
        <h2 class="form-signin-heading">Please login</h2>
        <input type="text" class="form-control mb-3" value="<?= $username ?? '' ?>" name="username"
               placeholder="Email Address" required="" autofocus=""/>
        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <h3 class="text-center text-danger mt-2"><?= $message ?? '' ?></h3>
    </form>
</div>