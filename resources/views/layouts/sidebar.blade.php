<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <!-- Dashboard -->
                <li>
                    <a href="{{url('/')}}" class=" waves-effect">
                        <i class="mdi mdi-calendar"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('departements.liste')}}" class=" waves-effect">
                        <i class="mdi mdi-office-building"></i>
                        <span>Départements</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('materiels.liste')}}" class=" waves-effect">
                        <i class="mdi mdi-valve"></i>
                        <span>Matériel</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('category.liste')}}" class=" waves-effect">
                        <i class="mdi mdi-puzzle"></i>
                        <span>Catégorie</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('users.liste')}}" class=" waves-effect">
                        <i class="mdi mdi-account-group"></i>
                        <span>Employés</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
