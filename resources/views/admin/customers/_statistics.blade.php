 <div class="row">

     <div class="col-12 col-sm-6 col-md-3">
         <div class="info-box mb-3">
             <span class="info-box-icon bg-success elevation-1">
                 <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                     class="bi bi-cash-stack" viewBox="0 0 16 16">
                     <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                     <path
                         d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
                 </svg>
             </span>
             <div class="info-box-content">
                 <span class="info-box-text">Balance</span>
                 <span class="info-box-number">{{ number_format($customer->balance, 2) }} Unit</span>
             </div>
         </div>
     </div>

     <div class="col-12 col-sm-6 col-md-3">
         <div class="info-box mb-3">
             <span class="info-box-icon bg-info elevation-1">
                 <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                     class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                     <path
                         d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                 </svg>
             </span>
             <div class="info-box-content">
                 <span class="info-box-text">Deposits</span>
                 <span class="info-box-number">{{ number_format($totalAmount, 2) }} Unit</span>
             </div>
         </div>
     </div>


     <div class="col-12 col-sm-6 col-md-3">
         <div class="info-box">
             <span class="info-box-icon bg-warning elevation-1">
                 <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                     class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                     <path
                         d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                 </svg>
             </span>
             <div class="info-box-content">
                 <span class="info-box-text">Withdraw</span>
                 <span class="info-box-number">
                     {{ number_format($totalAmountW, 2) }} Unit
                 </span>
             </div>
         </div>
     </div>


     <!-- /.col -->
     {{-- <div class="col-12 col-sm-6 col-md-3">
         <div class="info-box mb-3">
             <span class="info-box-icon bg-primary elevation-1">
                 <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                     class="bi bi-card-list" viewBox="0 0 16 16">
                     <path
                         d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                     <path
                         d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                 </svg>
             </span>
             <div class="info-box-content">
                 <span class="info-box-text">Transactions</span>
                 <span class="info-box-number">0.00 Unit</span>
             </div>
         </div>
     </div>
 </div> --}}

 <div class="row mt-3 mb-4">
     <div class="col-md-2">
        <a  href="{{route('admin.customer.show',$customer->id)}}"  class="btn {{Request::routeIs('admin.customer.show') ? 'btn-primary' : 'btn-outline-primary'}} w-100">User Information</a>
    </div>

    <div class="col-md-2">
        <a href="{{route('admin.customer.balance',$customer->id)}}" class="btn {{Request::routeIs('admin.customer.balance') ? 'btn-primary' : 'btn-outline-primary'}} w-100">Manage balance</a>
    </div>

    @if($customer->type === "Customer")
     <div class="col-md-2">
        <a  href="{{route('admin.customer.2d.list',$customer->id)}}" class="btn {{Request::routeIs('admin.customer.2d.list') ? 'btn-primary' : 'btn-outline-primary'}} w-100">2D Betting List</a>
    </div>

     <div class="col-md-2">
        <a  href="{{route('admin.customer.3d.list',$customer->id)}}" class="btn {{Request::routeIs('admin.customer.3d.list') ? 'btn-primary' : 'btn-outline-primary'}} w-100">3D Betting List</a>
    </div>

     <div class="col-md-2">
        <a  href="{{route('admin.customer.thaid.list',$customer->id)}}" class="btn {{Request::routeIs('admin.customer.thaid.list') ? 'btn-primary' : 'btn-outline-primary'}} w-100">ThaiD Betting List</a>
    </div>

    @endif
    <div class="col-md-2">
        <a href="{{route('admin.customer.transactions',$customer->id)}}"  class="btn {{Request::routeIs('admin.customer.transactions') ? 'btn-primary' : 'btn-outline-primary'}} w-100">Transactions</a>
    </div>
 </div>
