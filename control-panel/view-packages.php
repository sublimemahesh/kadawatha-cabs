<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$VTYPE = new VehicleType($id);
?> 
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Packages || WEB SITE CONTROL PANEL </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid">

                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Create Package</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-vehicle-type.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            $vali = new Validator();
                            $vali->show_message();
                            ?>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/packages.php" enctype="multipart/form-data"> 
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Package Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="name" class="form-control"  autocomplete="off" placeholder="Package Name" name="name" required="true">
                                                    <!--<label class="form-label">Package Name</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Package Code</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="code" class="form-control"  autocomplete="off" name="code" placeholder="Package Code" required="true">
                                                    <!--<label class="form-label">Package Code</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="vehicle_type">Vehicle Type</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" value="<?php echo $VTYPE->type; ?>" readonly="">
                                                    <input type="hidden" name="vehicle_type" id="vehicle_type" value="<?php echo $VTYPE->id; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Vehicle Category-->
                                    <div class="row clearfix" id="category-bar">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="category">Category</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="category" name="category" required="TRUE">
                                                        <option value=""> -- Please Select Category -- </option>
                                                        <?php
                                                        $categories = VehicleCategory::GetCategoryByType($id);
                                                        foreach ($categories as $category) {
                                                            ?>
                                                            <option value="<?php echo $category['id']; ?>">
                                                                <?php echo $category['name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Vehicle SubCategory-->
                                    <div class="row clearfix" id="subcategory-bar"></div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="package_type">Type</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="package_type" name="package_type" required="TRUE">
                                                        <option value=""> -- Please Select Package Type -- </option>
                                                        <?php
                                                        $types = PackageType::all();
                                                        foreach ($types as $type) {
                                                            ?>
                                                            <option value="<?php echo $type['id']; ?>">
                                                                <?php echo $type['name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="no_of_days">No of Days</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="no_of_days" class="form-control"  autocomplete="off" name="no_of_days" placeholder="No of Days">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Price (Rs)</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="price" class="form-control"  autocomplete="off" name="price" placeholder="Price (Rs)">
                                                    <!--<label class="form-label">Price (Rs)</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Time (h)</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="time" class="form-control"  autocomplete="off" name="time" placeholder="Time (h)">
                                                    <!--<label class="form-label">Time (h)</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Distance (km)</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="distance" class="form-control"  autocomplete="off" name="distance" min="0" placeholder="Distance (km)">
                                                    <!--<label class="form-label">Distance (km)</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="extra_price_1km">Extra price for 1km (Rs)</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="extra_price_1km" class="form-control"  autocomplete="off" name="extra_price_1km"  placeholder="Extra price for 1km (Rs)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="extra_price_1h">Extra price for 1h (Rs)</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="extra_price_1h" class="form-control"  autocomplete="off" name="extra_price_1h" placeholder="Extra price for 1h (Rs)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Description </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <label class="form-label"></label>
                                                <div class="form-line">
                                                    <textarea id="description" name="description" class="form-control" rows="5"></textarea> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" name="create" class="btn btn-primary m-t-15 waves-effect" value="create"/>
                                    </div>
                                    <div class="row clearfix">  </div>
                                    <hr/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Packages
                                </h2>
                            </div>
                            <div class="body">
                                <!-- <div class="table-responsive">-->
                                <div>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Package Name</th>
                                                <th>Package Code</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Option</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Package Name</th>
                                                <th>Package Code</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Option</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach (Packages::GetPackagesByVehicleType($id) as $key => $packages) {
                                                $CATEGORY = new VehicleCategory($packages['category']);
                                                $TYPE = new PackageType($packages['package_type']);
                                                $key++;
                                                ?>
                                                <tr id="row_<?php echo $packages['id']; ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $packages['name']; ?></td>
                                                    <td><?php echo $packages['code']; ?></td>
                                                    <td><?php echo $CATEGORY->name; ?></td>
                                                    <td><?php echo $TYPE->name; ?></td>

                                                    <td> 
                                                        <a href="edit-packages.php?id=<?php echo $packages['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn" title="Edit Package"></button></a>
                                                        |

                                                        <a href="#"  class="delete-Packages" data-id="<?php echo $packages['id']; ?>">
                                                            <button class="glyphicon glyphicon-trash delete-btn delete-user" title="Delete Package" data-id="<?php echo $packages['id']; ?>"></button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Vertical Layout -->
            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/add-new-ad.js" type="text/javascript"></script>
        <script src="tinymce/js/tinymce/tinymce.min.js"></script>

        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="js/pages/ui/dialogs.js"></script>
        <script src="js/demo.js"></script>
        <script src="delete/js/vehicle-photo.js" type="text/javascript"></script>
        <script src="js/package-details.js" type="text/javascript"></script>
        <script>
            tinymce.init({
                selector: "#description",
                // ===========================================
                // INCLUDE THE PLUGIN
                // ===========================================

                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                // ===========================================
                // PUT PLUGIN'S BUTTON on the toolbar
                // ===========================================

                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                // ===========================================
                // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                // ===========================================

                relative_urls: false

            });


        </script>
    </body>

</html>