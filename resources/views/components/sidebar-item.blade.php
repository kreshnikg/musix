<li class="sidebar-item {{ $active ? "active" : ""}}">
    <a class="sidebar-link" href={{$link}} {{ $newTab ? "target=\"_blank\"" : "" }}>
        <i class="{{$icon}} fa-fw"></i>
        <span class="ml-2">{{$title}}</span>
        {{ $slot }}
    </a>
</li>
