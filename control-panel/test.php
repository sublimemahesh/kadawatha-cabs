<?php
include_once(dirname(__FILE__) . '/../class/include.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title> Create Vehicle || WEB SITE CONTROL PANEL </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <!--<link href="css/style.css" rel="stylesheet">-->
        <!--<link href="css/themes/all-themes.css" rel="stylesheet" />-->
    </head>
    
    
    <body>
        <form class="form-horizontal" method="post" action="post-and-get/permission.php" enctype="multipart/form-data"> 
            <div class="panel-body">
                <?php
                foreach (Permission::all() as $permission) {
                    ?>
                    <div class="col-md-6 checkbox">
                        <input class="" type="checkbox"  name="permission[]" value="<?php echo $permission['id']; ?>" id="permission-<?php echo $permisssion['id']; ?>" />
                        <label for="<?php echo $permission['id']; ?>"><?php echo $permission['permission']; ?></label>

                    </div>

                    <!--                                            
                                                                 <div class="col-md-6 checkbox">
                                                                        <input class="filled-in chk-col-pink" type="checkbox"  name="permission[]" value="del" id="del" />
                                                                        <label for="<?php echo $permission['permission']; ?>"><?php echo $permission['permission']; ?></label>
                    
                                                                    </div>-->

                    <?php
                }
                ?>
                <div class="col-md-12">
                    <input type="hidden" id="id" value="<?php echo $PERMISSION->id; ?>" name="id"/>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="updatePermission" value="updatePermission">Save Changes</button>
                </div>
            </div>
        </form>

</section>
<!-- Jquery Core Js -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="plugins/bootstrap/js/bootstrap.js"></script>
<!-- Select Plugin Js -->
<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- Slimscroll Plugin Js -->
<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="plugins/node-waves/waves.js"></script>
<!-- Jquery DataTable Plugin Js -->

<script src="plugins/sweetalert/sweetalert.min.js"></script>
<!-- Custom Js -->
<script src="js/admin.js"></script>
<!-- Demo Js -->
<script src="js/demo.js"></script>
<script src="js/user-permission.js" type="text/javascript"></script>
    </body>
</html>