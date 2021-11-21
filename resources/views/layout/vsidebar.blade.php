<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('template') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('template') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @foreach ($menu as $data)
            <li class="nav-item">            
                @if ($data->nmfile == "")
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-folder"></i>
                    <p>
                      {{$data->nama}}
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  @foreach ($submenu as $datasub)
                    @if (substr($datasub->orderby,0,1) == $data->orderby)
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ $datasub->nmfile }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{$datasub->nama}}</p>
                          </a>
                        </li>
                      </ul>                  
                    @endif
                  @endforeach
                @else
                  <a href="/{{ $data->nmfile }}" class="nav-link">
                    <i class="nav-icon fa fa-circle"></i>
                    <p>{{$data->nama}}</p>            
                  </a>    
                @endif            
            </li>
          @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>