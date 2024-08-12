@php
    use Illuminate\Support\Str;
    $currentRoute = Route::currentRouteName();
@endphp

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse sidebar-custom">
    <div class="sidebar-sticky pt-3 text-center">
        @if(Auth::check())
            @php
                $user = Auth::user();
                $names = explode(" ", $user->name);
                $initials = strtoupper(substr($names[0], 0, 1) . substr(end($names), 0, 1));
            @endphp
            <div class="profile-initials rounded-circle mb-3">{{ $initials }}</div>
            <p>Olá, {{ $user->name }}</p>
        @endif

        <ul class="nav flex-column text-left mt-4">
            <li class="nav-item mb-4">
                <a class="nav-link {{ $currentRoute == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i data-feather="home"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item mb-4">
                <button class="nav-link btn btn-link {{ Str::startsWith($currentRoute, 'cadastros') ? 'active' : '' }}" onclick="toggleSubMenu('cadastros-submenu')">
                    <i data-feather="users"></i>
                    Cadastros
                </button>
                <ul class="nav flex-column ml-3 {{ Str::startsWith($currentRoute, 'cadastros') ? '' : 'd-none' }}" id="cadastros-submenu">
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'cadastros.lojas' ? 'active' : '' }}" href="{{ route('cadastros.lojas') }}">Lojas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'cadastros.clientes' ? 'active' : '' }}" href="{{ route('cadastros.clientes') }}">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'cadastros.produtos' ? 'active' : '' }}" href="{{ route('cadastros.produtos') }}">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'cadastros.fornecedores' ? 'active' : '' }}" href="{{ route('cadastros.fornecedores') }}">Fornecedores</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mb-4">
                <button class="nav-link btn btn-link" onclick="toggleSubMenu('financeiro-submenu')">
                    <i data-feather="dollar-sign"></i>
                    Financeiro
                </button>
                <ul class="nav flex-column ml-3 d-none" id="financeiro-submenu">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 2</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mb-4">
                <button class="nav-link btn btn-link" onclick="toggleSubMenu('produtos-submenu')">
                    <i data-feather="box"></i>
                    Produtos
                </button>
                <ul class="nav flex-column ml-3 d-none" id="produtos-submenu">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 2</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mb-4">
                <button class="nav-link btn btn-link" onclick="toggleSubMenu('servicos-submenu')">
                    <i data-feather="briefcase"></i>
                    Serviços
                </button>
                <ul class="nav flex-column ml-3 d-none" id="servicos-submenu">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 2</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mb-4">
                <button class="nav-link btn btn-link" onclick="toggleSubMenu('estoque-submenu')">
                    <i data-feather="layers"></i>
                    Estoque
                </button>
                <ul class="nav flex-column ml-3 d-none" id="estoque-submenu">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 2</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mb-4">
                <button class="nav-link btn btn-link" onclick="toggleSubMenu('compras-submenu')">
                    <i data-feather="shopping-cart"></i>
                    Compras
                </button>
                <ul class="nav flex-column ml-3 d-none" id="compras-submenu">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Sub-opção 2</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mb-4">
                <a class="nav-link {{ $currentRoute == 'lojas.index' ? 'active' : '' }}" href="{{ route('lojas.index') }}">
                    <i data-feather="share-2"></i>
                    Lojas
                </a>
            </li>
        </ul>
    </div>
</nav>
