  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dash.index')}}" class="brand-link">
      <img src="/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Pharma Salim</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('profil.index')}}" class="d-block">{{Auth::user()->name}}</a>
          @if(Auth::user()->admin == 1 )
           <span class="badge badge-success">ADMIN</span>
          @endif
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column sidebar-light " data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{route('dash.index')}}" id="dash">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
              </p>
            </a>
          </li>
          <li id="top">
            <a href="#" id="management">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Management
                <i class="right fas fa-angle-left "></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('medicaments.index')}}" id="medicaments">
                  <i class="nav-icon fas fa-capsules"></i>
                  <p>Médicaments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('fournisseur.index')}}" id="fournisseur">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Fourniseurs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('pharmacien.index')}}" id="pharmacien">
                  <i class="nav-icon fas fa-user-md"></i>
                  <p>Pharmaciens</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('achats.index')}}" id="achats">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Achat Médicament
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('ventes.index')}}" id="ventes">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Vente Médicament
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('profil.index')}}" id="profile">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('logout') }}" id="off">
              <i class="nav-icon fa fa-power-off"></i>
              <p>
                Déconnexion
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>