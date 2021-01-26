<div class="col-md-1 container-fluid">
    <aside class="sidebar-left-collapse">
        <h2 align="center">
            <a href="{{ url('/home') }}" class="company-logo">
                <img class="img" src="{{ asset('img/logo.png') }}" alt=""/>
            </a>
        </h2>
        <div class="sidebar-links">
            <div class="link-blue">
                <a href="#">
                    <i class="fa fa-keyboard-o"></i>Usuário
                </a>
                <ul class="sub-links">
                    @if((auth()->user()->access_level) > 2)
                    <li><a href="{{ route('register') }}">Adicionar</a></li>
                    <li><a href="{{ route('activities.index') }}">Logs de atividade</a></li>
                    @endif
                    <li><a href="{{ route('changeData.index') }}">Editar perfil</a></li>
                        <li><a href="{{ route('user.index') }}">Gerenciamento</a></li>

                </ul>
            </div>
            <div class="link-red">
                <a href="#">
                    <i class="fa fa-keyboard-o"></i>Produto
                </a>
                <ul class="sub-links">
                    @if((auth()->user()->access_level) >  2)
                        <li><a href="{{ route('product.create') }}">Adicionar</a></li>
                    @endif
                    <li><a href="{{ route('product.index') }}">Listar</a></li>
                </ul>
            </div>
            <div class="link-blue">
                <a href="#">
                    <i class="fa fa-keyboard-o"></i>Itens
                </a>
                <ul class="sub-links">
                    <li><a href="{{ route('inout.index') }}">Listar</a></li>
                    <li><a href="{{ route('request_admin') }}">Solicitação direta</a></li>
                </ul>
            </div>
            @if((auth()->user()->access_level) >  2)
                <div class="link-red">
                    <a href="#">
                        <i class="fa fa-keyboard-o"></i>Área
                    </a>
                    <ul class="sub-links">
                        <li><a href="{{ route('area.create') }}">Adicionar</a></li>
                        <li><a href="{{ route('area.index') }}">Listar</a></li>
                        <li><a href="{{ route('inout.create') }}">Associar a produto</a></li>
                    </ul>
                </div>
            @endif
            <div class="link-blue">
                <a href="#">
                    <i class="fa fa-keyboard-o"></i>Registros
                </a>
                <ul class="sub-links">
                    <li><a href="{{ route('approved_requests') }}">Solicitações</a></li>
                    @if((auth()->user()->access_level) >  2)
                        <li><a href="{{ route('reportPage') }}">Relatórios</a></li>
                    @endif
                </ul>
            </div>
            @if((auth()->user()->access_level) > 2)
            <div class="link-red">
                <a href="{{ route('backup.index') }}">
                    <i class="fa fa-keyboard-o"></i>Backup
                </a>
            </div>
            @endif

        </div>
    </aside>
</div>
