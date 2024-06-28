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
                    <li @if(in_array(Request::segment(1),['clients','commercials','fournisseurs'])) class="mm-active" @endif>
                        <a href="javascript: void(0);"
                           class="has-arrow  waves-effect @if(in_array(Request::segment(1),['clients','commercials','fournisseurs'])) mm-active @endif"
                           aria-expanded="false">
                            <i class="mdi mdi-contacts"></i>
                            <span>Contacts</span>
                        </a>
                        <ul class="sub-menu mm-collapse @if(in_array(Request::segment(1),['clients','commercials','fournisseurs'])) mm-show @endif"
                            aria-expanded="false">

                                <li @if(Request::segment(1)==='clients') class="mm-active" @endif><a
                                        href=""
                                        @if(Request::segment(1)==='clients') class="active" @endif >Client</a></li>
                                <li @if(Request::segment(1)==='fournisseurs') class="mm-active" @endif><a
                                        href=""
                                        @if(Request::segment(1)==='fournisseurs') class="active" @endif>Fournisseur</a>
                                </li>
                                    <li @if(Request::segment(1)==='commercials') class="mm-active" @endif><a
                                            href=""
                                            @if(Request::segment(1)==='commercials') class="active" @endif >Commerciaux</a>
                                    </li>
                        </ul>
                    </li>
                    <li>
                        <a href="" class=" waves-effect">
                            <i class="mdi mdi-cash-register"></i>
                            <span>Point de vente</span>
                        </a>
                    </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
