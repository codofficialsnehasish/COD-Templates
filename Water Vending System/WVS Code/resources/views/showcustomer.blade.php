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
                                    <h6 class="page-title">Customers</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Customers</li>
                                    </ol>
                                </div>
                                @if(Auth::user()->role == "Admin")
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/customer')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Account Number</th>
                                                    <th>Area</th>
                                                    <th>Meter</th>
                                                    <th>Status</th>
                                                    <th>Name</th>
                                                    <th>Telephone</th>
                                                    <th>Address</th>
                                                    <th>Bill Send Status</th>
                                                    <td>Payment</td>
                                                    <td>Recipt</td>
                                                    @if(Auth::user()->role == "Admin")
                                                    <!-- <th>Edit Customer</th> -->
                                                    <!-- <th>Delete Customer</th> -->
                                                    <th>Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($customer as $c)
                                               
                                                <tr>
                                                    <td>{{$c->c_account_number}}</td>
                                                    <td>{{$c->area}}</td>
                                                    <td>{{$c->name}}</td>
                                                    <td>{{$c->status}}</td>
                                                    <td>{{$c->cname}}</td>
                                                    <td>{{$c->cphone}}</td>
                                                    <td>{{$c->caddress}}</td>
                                                    <td>@if($c->bill_send_status == 'Success' ) {{$c->bill_send_status}} on {{$c->bill_send_date}} @endif @if($c->bill_send_status != 'Success' ){{$c->bill_send_status}} @endif</td>
                                                    <td style="text-align: center;font-size:15px;"><a href="{{url('/payment')}}/{{$c->cid}}" class="btn btn-primary">Payment</a></td>
                                                  
                                                    <td style="text-align: center;font-size:15px;">@foreach($bill as $b) @if($b->customer_id == $c->cid)<a href="{{url('/recipt')}}/{{$b->id}}" class="btn btn-info"><i class="ti-receipt"></i></a>@endif @endforeach</td>
                                                 
                                                    @if(Auth::user()->role == "Admin")
                                                    <!-- <td style="text-align: center;font-size:15px;"><a href="{{url('/editcustomer')}}/{{$c->cid}}"><i class="ti-check-box"></i></a></td> -->
                                                    <!-- <td style="text-align: center;"><a onclick="return confirm('Are you sure?')" href="{{url('/customerdel')}}/{{$c->cid}}"><i class="ti-trash"></i></a></td> -->
                                                    <td>
                                                        <a class="btn btn-success" href="{{url('/editcustomer')}}/{{$c->cid}}" alt="edit"><i class="ti-check-box"></i></a>
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('/customerdel')}}/{{$c->cid}}"><i class="ti-trash"></i></a>
                                                    </td>
                                                    @endif
                                                    
                                                </tr>
                                               
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end show data -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                @include("dash/footer")