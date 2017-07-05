<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        
        <div class="navbar-header">
            <!-- Branding Image -->
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <?php echo e(config('app.name', 'Laravel')); ?>

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