<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
            <div class="nav-collapse">
                <?php include('nav-main.php'); ?>
                <?php include('nav-template.php'); ?>
            </div><!--/.nav-collapse -->
        </div><!-- /.container -->
    </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->
