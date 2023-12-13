 @extends('admin.layout.app')
 @section('content')
     <div class="container">

         <nav aria-label="breadcrumb">
             <ol class="breadcrumb p-1 mt-1 bg-transparent">
                 <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
             </ol>
         </nav>
         <?php
         $report_overview = [
             [
                 'text_display' => 'Morning 2D',
                 'number_display' => '7912,7912',
                 'route' => 'admin.dashoard',
                 'url' => 'admin/dashoard',
                 'icon' => '2d.svg',
             ],
             [
                 'text_display' => '2D Sales',
                 'number_display' => '7912,7912',
                 'route' => 'admin.dashoard',
                 'url' => 'admin/dashoard',
                 'icon' => '3d.svg',
             ],
             [
                 'text_display' => 'Total Uses',
                 'number_display' => '7912',
                 'route' => 'admin.dashoard',
                 'url' => 'admin/dashoard',
                 'icon' => 'user.svg',
             ],
             [
                 'text_display' => 'Evening 2D',
                 'number_display' => '7912,7912',
                 'route' => 'admin.dashoard',
                 'url' => 'admin/dashoard',
                 'icon' => '2d.svg',
             ],
             [
                 'text_display' => 'Thai Lottery Sales',
                 'number_display' => '7912,7912',
                 'route' => 'admin.dashoard',
                 'url' => 'admin/dashoard',
                 'icon' => 'lottery.png',
             ],
             [
                 'text_display' => 'Total Users Balance',
                 'number_display' => '7912,7912',
                 'route' => 'admin.dashoard',
                 'url' => 'admin/dashoard',
                 'icon' => 'dollor.svg',
             ],
         ];
         ?>
         {{-- report overview --}}
         <div class="row no-gutters bg-light px-2">
             @foreach ($report_overview as $item)
                 <div class="col-md-4 px-1">
                     <div class="card">
                         <div class="card-body row">
                             <div class="col-2  rounded text-center">
                                 <h4 class="mt-2">
                                     <img src="{{ asset('admin/images/' . $item['icon']) }}" alt="AdminLTE Logo""
                                         style="height: 50px">
                                 </h4>
                             </div>
                             <div class="col-10 pl-3" style="width: 50px">
                                 {{ $item['text_display'] }} <br>
                                 <b>{{ $item['number_display'] }} </b>
                             </div>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>

         {{-- slides --}}
         <div class="bg-light px-3 mt-5 mb-5">
             <h2 class="pt-3">Slide Imgaes <div class="float-right">
                     <a href="{{ route('admin.slide.create') }}" class="btn btn-primary btn-sm">
                         <i class="fas fa-plus"></i>
                         Add new Slide
                     </a>
                 </div>
                 </h3>
                 <div class="row no-gutters mt-3">
                     @foreach ($slides as $slide)
                         <div class="col-12 col-md-4 px-2">
                             <div class="card">
                                 <div class="">
                                     <img src="{{ $slide->image }}" style="width: 100%;aspect-ratio:16/9;object-fit:cover"
                                         alt="">
                                     <p class="p-1 pb-0">{{$slide->link}}</p>
                                 </div>
                                 <div class="card-footer">
                                     <div class="d-flex">
                                         <h5>{{ $slide->name }}</h5>
                                         <div class="ml-auto">
                                             <a href="{{ route('admin.slide.edit', $slide->id) }}"
                                                 class="btn btn-sm btn-success">
                                                 <i class="fas fa-edit"></i>Edit
                                             </a>
                                             <a onclick="if(confirm('Are you sure you want to delete this?')){
                                    event.preventDefault();
                                    document.getElementById('slide-delete-{{ $slide->id }}').submit();
                                  }"
                                                 type="button" class="btn btn-sm btn-danger">
                                                 <i class="fa fa-trash"></i>
                                                 Delete
                                             </a>

                                             <form id="slide-delete-{{ $slide->id }}"
                                                 action="{{ route('admin.slide.destroy', $slide->id) }}" method="POST">
                                                 @csrf
                                                 @method('DELETE')
                                             </form>

                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                      <h2 class="">Slide Text
                         @if ($slidetext)
                             <div class="card w-50 p-3 mt-3">
                             <div class="d-flex justify-content-between">
                                 <div>
                                     <h6 class="mt-2">{{$slidetext?->text}}</h6>
                                 </div>
                                 <div class="">
                                     <a href="{{ route('admin.slidetext.edit', $slidetext->id) }}" class="btn btn-sm btn-success">
                                         <i class="fas fa-edit"></i>Edit
                                     </a>
                                     {{-- <a href="{{route('admin.slidetext.destory',$slidetext->id)}}"
                                         type="button" class="btn btn-sm btn-danger">
                                         <i class="fa fa-trash"></i>
                                         Delete
                                     </a> --}}
                                 </div>
                             </div>
                         </div>
                         @endif
                 </div>
         </div>


     </div>

     {{-- <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Dashboard v3</h1>
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">Dashboard v3</li>
                     </ol>
                 </div><!-- /.col -->
             </div><!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-lg-6">
                     <div class="card">
                         <div class="card-header border-0">
                             <div class="d-flex justify-content-between">
                                 <h3 class="card-title">Online Store Visitors</h3>
                                 <a href="javascript:void(0);">View Report</a>
                             </div>
                         </div>
                         <div class="card-body">
                             <div class="d-flex">
                                 <p class="d-flex flex-column">
                                     <span class="text-bold text-lg">820</span>
                                     <span>Visitors Over Time</span>
                                 </p>
                                 <p class="ml-auto d-flex flex-column text-right">
                                     <span class="text-success">
                                         <i class="fas fa-arrow-up"></i> 12.5%
                                     </span>
                                     <span class="text-muted">Since last week</span>
                                 </p>
                             </div>
                             <!-- /.d-flex -->

                             <div class="position-relative mb-4">
                                 <canvas id="visitors-chart" height="200"></canvas>
                             </div>

                             <div class="d-flex flex-row justify-content-end">
                                 <span class="mr-2">
                                     <i class="fas fa-square text-primary"></i> This Week
                                 </span>

                                 <span>
                                     <i class="fas fa-square text-gray"></i> Last Week
                                 </span>
                             </div>
                         </div>
                     </div>
                     <!-- /.card -->

                     <div class="card">
                         <div class="card-header border-0">
                             <h3 class="card-title">Products</h3>
                             <div class="card-tools">
                                 <a href="#" class="btn btn-tool btn-sm">
                                     <i class="fas fa-download"></i>
                                 </a>
                                 <a href="#" class="btn btn-tool btn-sm">
                                     <i class="fas fa-bars"></i>
                                 </a>
                             </div>
                         </div>
                         <div class="card-body table-responsive p-0">
                             <table class="table table-striped table-valign-middle">
                                 <thead>
                                     <tr>
                                         <th>Product</th>
                                         <th>Price</th>
                                         <th>Sales</th>
                                         <th>More</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>
                                             <img src="dist/img/default-150x150.png" alt="Product 1"
                                                 class="img-circle img-size-32 mr-2">
                                             Some Product
                                         </td>
                                         <td>$13 USD</td>
                                         <td>
                                             <small class="text-success mr-1">
                                                 <i class="fas fa-arrow-up"></i>
                                                 12%
                                             </small>
                                             12,000 Sold
                                         </td>
                                         <td>
                                             <a href="#" class="text-muted">
                                                 <i class="fas fa-search"></i>
                                             </a>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <img src="dist/img/default-150x150.png" alt="Product 1"
                                                 class="img-circle img-size-32 mr-2">
                                             Another Product
                                         </td>
                                         <td>$29 USD</td>
                                         <td>
                                             <small class="text-warning mr-1">
                                                 <i class="fas fa-arrow-down"></i>
                                                 0.5%
                                             </small>
                                             123,234 Sold
                                         </td>
                                         <td>
                                             <a href="#" class="text-muted">
                                                 <i class="fas fa-search"></i>
                                             </a>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <img src="dist/img/default-150x150.png" alt="Product 1"
                                                 class="img-circle img-size-32 mr-2">
                                             Amazing Product
                                         </td>
                                         <td>$1,230 USD</td>
                                         <td>
                                             <small class="text-danger mr-1">
                                                 <i class="fas fa-arrow-down"></i>
                                                 3%
                                             </small>
                                             198 Sold
                                         </td>
                                         <td>
                                             <a href="#" class="text-muted">
                                                 <i class="fas fa-search"></i>
                                             </a>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <img src="dist/img/default-150x150.png" alt="Product 1"
                                                 class="img-circle img-size-32 mr-2">
                                             Perfect Item
                                             <span class="badge bg-danger">NEW</span>
                                         </td>
                                         <td>$199 USD</td>
                                         <td>
                                             <small class="text-success mr-1">
                                                 <i class="fas fa-arrow-up"></i>
                                                 63%
                                             </small>
                                             87 Sold
                                         </td>
                                         <td>
                                             <a href="#" class="text-muted">
                                                 <i class="fas fa-search"></i>
                                             </a>
                                         </td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                     <!-- /.card -->
                 </div>
                 <!-- /.col-md-6 -->
                 <div class="col-lg-6">
                     <div class="card">
                         <div class="card-header border-0">
                             <div class="d-flex justify-content-between">
                                 <h3 class="card-title">Sales</h3>
                                 <a href="javascript:void(0);">View Report</a>
                             </div>
                         </div>
                         <div class="card-body">
                             <div class="d-flex">
                                 <p class="d-flex flex-column">
                                     <span class="text-bold text-lg">$18,230.00</span>
                                     <span>Sales Over Time</span>
                                 </p>
                                 <p class="ml-auto d-flex flex-column text-right">
                                     <span class="text-success">
                                         <i class="fas fa-arrow-up"></i> 33.1%
                                     </span>
                                     <span class="text-muted">Since last month</span>
                                 </p>
                             </div>
                             <!-- /.d-flex -->

                             <div class="position-relative mb-4">
                                 <canvas id="sales-chart" height="200"></canvas>
                             </div>

                             <div class="d-flex flex-row justify-content-end">
                                 <span class="mr-2">
                                     <i class="fas fa-square text-primary"></i> This year
                                 </span>

                                 <span>
                                     <i class="fas fa-square text-gray"></i> Last year
                                 </span>
                             </div>
                         </div>
                     </div>
                     <!-- /.card -->

                     <div class="card">
                         <div class="card-header border-0">
                             <h3 class="card-title">Online Store Overview</h3>
                             <div class="card-tools">
                                 <a href="#" class="btn btn-sm btn-tool">
                                     <i class="fas fa-download"></i>
                                 </a>
                                 <a href="#" class="btn btn-sm btn-tool">
                                     <i class="fas fa-bars"></i>
                                 </a>
                             </div>
                         </div>
                         <div class="card-body">
                             <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                 <p class="text-success text-xl">
                                     <i class="ion ion-ios-refresh-empty"></i>
                                 </p>
                                 <p class="d-flex flex-column text-right">
                                     <span class="font-weight-bold">
                                         <i class="ion ion-android-arrow-up text-success"></i> 12%
                                     </span>
                                     <span class="text-muted">CONVERSION RATE</span>
                                 </p>
                             </div>
                             <!-- /.d-flex -->
                             <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                 <p class="text-warning text-xl">
                                     <i class="ion ion-ios-cart-outline"></i>
                                 </p>
                                 <p class="d-flex flex-column text-right">
                                     <span class="font-weight-bold">
                                         <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                                     </span>
                                     <span class="text-muted">SALES RATE</span>
                                 </p>
                             </div>
                             <!-- /.d-flex -->
                             <div class="d-flex justify-content-between align-items-center mb-0">
                                 <p class="text-danger text-xl">
                                     <i class="ion ion-ios-people-outline"></i>
                                 </p>
                                 <p class="d-flex flex-column text-right">
                                     <span class="font-weight-bold">
                                         <i class="ion ion-android-arrow-down text-danger"></i> 1%
                                     </span>
                                     <span class="text-muted">REGISTRATION RATE</span>
                                 </p>
                             </div>
                             <!-- /.d-flex -->
                         </div>
                     </div>
                 </div>
                 <!-- /.col-md-6 -->
             </div>
             <!-- /.row -->
         </div>
         <!-- /.container-fluid -->
     </div> --}}
 @endsection
