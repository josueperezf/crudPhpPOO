<ul class="sidenav" id="mobile-demo">
    <li>
        <div class="user-view">
            <div class="background" align='center'>
                <img src="assets/img/usuario.png" alt="" srcset="" width='150px'>
            </div>
            <!--<a href="#user"><img class="circle" src="{{ asset('image/yuna.jpg') }}"></a> -->
            <a href="#">
            <!-- white-text clase colocar letras en blanco-->
                <span class=" name">
                    JOSUE
                </span>
            </a>
            <a href="#">
                <span class=" email">
                    josueperezf@gmail.com
                </span>
            </a>
            <div class="row">
                <div class="col s6">
                    <a class="nav-link modal-trigger waves-effect waves-light btn btn-small" href="#modal1" 
                    onClick="$('.modal').modal();libAjaxGet('auths/edit','divModal')">
                        Editar
                    </a>
                </div>
                <div class="col s6">
                    <a class='btn waves-effect waves-light red lighten-2'  href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?controller=bodega&action=index">Bodega</a>
    </li>
</ul>