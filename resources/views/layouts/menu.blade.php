<li class="{{ Request::is('wisatawans*') ? 'active' : '' }}">
    <a href="{!! route('wisatawans.index') !!}"><i class="fa fa-edit"></i><span>wisatawans</span></a>
</li>

<li class="{{ Request::is('bahasas*') ? 'active' : '' }}">
    <a href="{!! route('bahasas.index') !!}"><i class="fa fa-edit"></i><span>bahasas</span></a>
</li>

<li class="{{ Request::is('destinasis*') ? 'active' : '' }}">
    <a href="{!! route('destinasis.index') !!}"><i class="fa fa-edit"></i><span>destinasis</span></a>
</li>

<li class="{{ Request::is('pemandus*') ? 'active' : '' }}">
    <a href="{!! route('pemandus.index') !!}"><i class="fa fa-edit"></i><span>pemandus</span></a>
</li>

<li class="{{ Request::is('bahasaPemandus*') ? 'active' : '' }}">
    <a href="{!! route('bahasaPemandus.index') !!}"><i class="fa fa-edit"></i><span>bahasa_pemandus</span></a>
</li>

<li class="{{ Request::is('beritas*') ? 'active' : '' }}">
    <a href="{!! route('beritas.index') !!}"><i class="fa fa-edit"></i><span>beritas</span></a>
</li>

