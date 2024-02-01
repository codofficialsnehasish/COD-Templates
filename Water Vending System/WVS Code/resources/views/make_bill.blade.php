<!-- adding header -->
@include("dash/header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("dash/left_side_bar")
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title">Make Bill</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/show_bill')}}">Bills</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">make New Bill</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/show_bill')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                            <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- register -->
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Make new Bill</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/postbill')}}" method="post">
                                                    @csrf
                                                    <div class="md-3">
                                                        <label for="custo" class="form-label">Customer</label>
                                                        <select class="form-select" id="custo" name="customer" onchange="req(this.value)" required>
                                                            <option selected disabled value="">Choose Customer</option>
                                                            @foreach($customer as $c)
                                                            <option @if(isset($name) && $name->cname == $c->cname) selected @endif value="{{$c->cid}}">{{$c->cname}}</option>
                                                            @endforeach
                                                            <!-- <option value="{{$c->cid}}">{{$c->cname}}</option> -->
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="input-date1">Date</label>
                                                        <input type="date" id="input-date1" value="20@php echo date('y-m-d') @endphp" name="date" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" required>
                                                        <span class="text-muted">e.g "dd/mm/yyyy"</span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="currb">Current Unit</label>
                                                        <input type="text" class="form-control" name="curru" id="currb" placeholder="Enter current unit" required>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="prevb">Previous Unit</label>
                                                        <input type="text" id="punit" class="form-control" name="prevu" id="prevb" placeholder="Enter previous unit" required>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="preb">Previous Bill</label>
                                                        <input type="text" id="pbal" class="form-control" name="preb" id="preb" placeholder="Enter previous bill" required>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="paid">Paid</label>
                                                        <input type="text" class="form-control" name="paid" id="paid" placeholder="Enter paid amount" required>
                                                    </div>
                                                    <div class="md-3">
                                                        <label for="pmode" class="form-label">Payment Mode</label>
                                                        <select class="form-select" id="pmode" name="pmode" required>
                                                            <option selected disabled value="">Choose Payment Mode</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Paybill">Paybill</option>
                                                            <!-- <option value="Cash">Cash</option> -->
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div>
                                                    <div class="mb-0 mt-3">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Make Bill & Payment</button>
                                                            <!-- <button type="reset" class="btn btn-secondary waves-effect">Cancel</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <script>
                    function req(id){
		                // alert(id)
		                // $('#dropdown'+id).html('');
                        $.ajax({
		                	url:'/bireq/'+id,
		                	type:'GET',
		                	data: {},
		                	success:function(resp){
		                		// alert(JSON.stringify(resp))
                                // const data = JSON.parse(resp);
                                console.log(resp.obj[0].previous_unit);
                                $('#punit').val(resp.obj[0].previous_unit);
                                reqb(id);
		                	}
		                })
                    }

                    function reqb(id){
		                // alert(id)
		                // $('#dropdown'+id).html('');
                        $.ajax({
		                	url:'/pbal/'+id,
		                	type:'GET',
		                	data: {},
		                	success:function(resp){
		                		// alert(JSON.stringify(resp))
                                // const data = JSON.parse(resp);
                                console.log(resp.obj[0].pre_bill);
                                $('#pbal').val(resp.obj[0].pre_bill);
		                	}
		                })
                    }
                </script>
                        
                        <!-- end register -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                @include("dash/footer")
