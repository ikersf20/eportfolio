<section id="header" class="wrapper">

    <!-- Logo -->
    <div id="logo">
        @yield('logo')
    </div>

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li>
                <a href="#">Familias Profesionales</a>
                <ul>
                    <li><a
                            href="{{ action([App\Http\Controllers\FamiliasProfesionalesController::class, 'getIndex']) }}">Listado</a>
                    </li>
                    @auth
                    <li><a
                            href="{{ action([App\Http\Controllers\FamiliasProfesionalesController::class, 'getCreate']) }}">Create</a>
                    </li>
                    @endauth
                </ul>
            </li>
            <li>
                <a href="#">Ciclos Formativos</a>
                <ul>
                    <li><a
                            href="{{ action([App\Http\Controllers\CiclosFormativosController::class, 'getIndex']) }}">Listado</a>
                    </li>
                    @auth
                    <li><a
                            href="{{ action([App\Http\Controllers\CiclosFormativosController::class, 'getCreate']) }}">Create</a>
                    </li>
                    @endauth
                </ul>
            </li>
            <li>
                <a href="#">Resultados Aprendizaje</a>
                <ul>
                    <li><a
                            href="{{ action([App\Http\Controllers\ResultadosAprendizajeController::class, 'getIndex']) }}">Listado</a>
                    </li>
                    @auth
                    <li><a
                            href="{{ action([App\Http\Controllers\ResultadosAprendizajeController::class, 'getCreate']) }}">Create</a>
                    </li>
                    @endauth
                </ul>
            </li>
            <li>
                <a href="#">Criterios evaluacion</a>
                <ul>
                    <li><a
                            href="{{ action([App\Http\Controllers\CriteriosEvaluacionController::class, 'getIndex']) }}">Listado</a>
                    </li>
                    @auth
                    <li><a
                            href="{{ action([App\Http\Controllers\CriteriosEvaluacionController::class, 'getCreate']) }}">Create</a>
                    </li>
                    @endauth
                </ul>
            </li>
            @auth
                <li>
                    {{ Auth::user()->name }}
                    <ul>
                        <li>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth
            @if (Route::has('login'))
                @auth
                    <li><a href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Dashboard
                        </a></li>
                @else
                    <li><a href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                            Log in
                        </a></li>

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a></li>
                    @endif
                @endauth
            @endif
        </ul>
    </nav>

</section>
