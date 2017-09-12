<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">

        <div class="navbar-header">
            <!-- Branding Image -->
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
              <object type="image/svg+xml" data=<?php echo e(asset('images/octaco.svg')); ?> style="width: 50px;margin-top: -5px;">
                Your browser does not support SVG
                </object>
                <p class="pull-right"><?php echo e(config('app.name', 'Laravel')); ?></p>
            </a>
        </div>

        <div>
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->

                <li><a href="<?php echo e(route('login')); ?>">Login</a></li>


            </ul>
        </div>

    </div>
 </nav>
