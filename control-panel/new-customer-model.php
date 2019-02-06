<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Create Customer</h4>
            </div>
            <div class="modal-body">
                <!--<form class="form-horizontal"  method="post" action="" enctype="multipart/form-data">--> 
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="name">Full Name</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="fullname" class="form-control"  autocomplete="off" name="fullname" required="true">
                                <label class="form-label">Full Name</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="name">Address</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="address" class="form-control"  autocomplete="off" name="address" >
                                <label class="form-label">Address</label>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="name">NIC</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="nic" class="form-control"  autocomplete="off" name="nic" >
                                <label class="form-label">NIC</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="name">Mobile Number</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="mobile_number" class="form-control"  autocomplete="off" name="mobile_number" >
                                <label class="form-label">Mobile Number</label>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="name">City</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="city" class="form-control"  autocomplete="off" name="city" >
                                <label class="form-label">City</label>
                            </div>
                        </div>
                    </div>    
                </div>

                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                    <button type="button" class="btn btn-primary" id="createCustomer" data-whatever="">Save</button>
                </div>
                <div class="row clearfix">  </div>
                <hr/>
                <!--</form>-->
            </div>

        </div>
    </div>
</div>