<section class="content">

    <div class="error-page">
        <h2 class="headline text-red"><?= $errr_num ?></h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3> 
            <p>
                We will work on fixing that right away.
                Meanwhile, you may <a href="<?= base_url() ?>">return to dashboard</a>.
            </p>
            <p>
                <?= $err_url ?> <br/>
                <?= $err_text ?> <br/>
            </p>

        </div>
    </div>
    <!-- /.error-page -->

</section>