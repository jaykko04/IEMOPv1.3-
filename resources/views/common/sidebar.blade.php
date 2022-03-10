<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/Users/home') }}">
        <div class="sidebar-brand-icon">
           
        </div>
        <div class="sidebar-brand-text mx-3"><img src="{{url('/img/iemoplogo.png')}}" alt="Image" style="width: 150px"/></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/Users/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
     <li class="nav-item">
        <a class="nav-link" href="{{ url('/Users/compliance') }}">
            <i class="fas fa-calendar"></i>
            <span>Compliance</span></a>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="{{ url('/Users/expired') }}">
            <i class="fas fa-calendar"></i>
            <span>Expired</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>REC Transactions</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Choose:</h6>
                <a class="collapse-item" href="{{ url('/Users/AddTransaction') }}">Add New Transaction</a>
                <a class="collapse-item" href="{{ url('/Users/PendingTransactions') }}">Pending Transactions</a>
                <a class="collapse-item" href="{{ url('/Users/ApprovedTransactions') }}">Approved Transactions</a>
                <a class="collapse-item" href="{{ url('/Users/ScheduledTransactions') }}">Scheduled Transactions</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Reporting</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Choose:</h6>
             
            <a class="collapse-item" href="{{ url('/Users/Search') }}">Monthly RECs Report </a>
             </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

   
</ul>