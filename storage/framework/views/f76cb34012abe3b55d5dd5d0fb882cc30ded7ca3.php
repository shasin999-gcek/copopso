<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

         <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Styles -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
        </script>
        
    
    </head>

    <body>
         
   

         <?php if(Auth::guest()): ?>

              <div id="guest">

                 <?php echo $__env->make('layouts.guest-nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                 <?php echo $__env->yieldContent('guest_content'); ?>
                 
              </div>  

         <?php else: ?>

             <div id="wrapper">

                <?php echo $__env->make('layouts.nav-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div id="page-wrapper">
                  
                    <?php echo $__env->yieldContent('main_content'); ?>
                      
                </div>

             </div>

         <?php endif; ?>    

    

       
     <script src="<?php echo e(URL::asset('js/app.js')); ?>"></script>
     <script src="https://use.fontawesome.com/62b073ec0c.js"></script>

      <?php echo $__env->yieldContent('add-script'); ?>
       
    </body>
</html>
