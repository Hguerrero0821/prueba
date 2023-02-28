<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>INICIO</p>
    </a>
</li>

{{--
<li class="nav-item">
    <a href="{{ route('prueba') }}" class="nav-link {{ Request::is('prueba') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>prueba</p>
    </a>
</li> --}}

<li class="nav-item menu-open">
    @php
        $menu_anterior = 0;
    @endphp
    @for ($i = 0; $i < sizeof($gbl_menus); $i++)
        @if (!($menu_anterior == $gbl_menus[$i]->menu_id))
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-duotone fa-handshake"></i>
                <p>
                        @php
                            echo $gbl_menus[$i]->name3;
                        @endphp
                </p>
                <i class="right fas fa-angle-left"></i>
            </a>

            <ul class="nav nav-treeview">
            @for ($j = 0; $j < sizeof($gbl_menus); $j++)
                @if ($gbl_menus[$i]->menu_id == $gbl_menus[$j]->menu_id)
                    <li class="nav-item">
                        <a href="{{$gbl_menus[$j]->url }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>

                                @php
                                    echo $gbl_menus[$j]->name2;
                                @endphp
                        </p>
                        </a>
                    </li>
                @endif

            @endfor
        </ul>
            @php
                $menu_anterior = $gbl_menus[$i]->menu_id;
            @endphp


        @endif



    @endfor


</li>


