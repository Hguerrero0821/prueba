<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="imgs/01-Ministerio-de-Gobierno-Vertical-2-a-todo-color.jpg"
             alt=""
             class="brand-image">
       <span class="brand-text font-weight-light">MENÚ</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
