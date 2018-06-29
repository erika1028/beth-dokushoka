<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
                <a class="navbar-brand" href="/"><img src="{{ secure_asset("images/logo.png") }}" alt="dokushoka" style="width: 100px; height: auto;"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
                </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @if (Auth::check())
                        <li class="nav-item active">
                              <a class="nav-link" href="{{ route('items.create') }}">
                                <span class="fa fa-plus" aria-hidden="true"></span>
                                add book
                            </a>
                        </li>
                        <li class="nav-item active">
                        <a class="nav-link" href="{{ route('ranking.read') }}"  role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-signal" aria-hidden="true"></span>
                                Ranking
                         </a>
                        </li>
                        <li class="nav-item active">
                        <a class="nav-link" href="{{ route('users.index', Auth::user()->id) }}"  role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-users" aria-hidden="true"></span>
                                Users
                         </a>
                        </li>  
                    
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="gravatar">
                                    <img src="{{ Gravatar::src(Auth::user()->email, 20) . '&d=mm' }}" alt="" class="rounded-circle">
                                </span>
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>
                            
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a  class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}"　class="dropdown-item">My page</a>
                                </li>
                                <li>
                                    <a  class="dropdown-item"  href="{{ route('timeline', Auth::user()->id) }}" class="dropdown-item">
                                      Timeline</a>
                                </li>
                                 <li>
                                    <a  class="dropdown-item"  href="{{ route('users.settings', Auth::user()->id) }}" class="dropdown-item">
                                        <i class="fas fa-cog"></i> Setting</a>
                                </li>
                                <li  class="dropdown-divider"></li>
                                <li>
                                    <a  class="dropdown-item" href="{{ route('logout.get') }}" class="dropdown-item">Logout</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a class="nav-link" href="{{ route('signup.get') }}">Registration</a></li>
                        <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endif
                </ul>
        </div>
        </div>
    </nav>
</header>