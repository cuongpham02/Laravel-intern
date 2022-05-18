<header class="py-3 border">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>Header</h1>
            </div>
            <div class="col-8 d-flex justify-content-end align-items-center">
                <ul class="nav">
                    <li class="nav-item">
                      <li class="nav-item">
                        {{ Auth::user()->name }} 
                        -
                        <b>{{ Auth::user()->is_role }}</b>
                      </li>
                      <a class="nav-link" href="#">
                        @if (Auth::check())
                            <a href="{{ route('logout') }}">Logout</a>
                        @endif
                      </a>
                    </li>
                  </ul>
            </div>
        </div>
    </div>
    </header>