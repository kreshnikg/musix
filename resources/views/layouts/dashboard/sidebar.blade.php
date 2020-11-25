<div id="sidebar" class="sidebar border-0">
    <ul class="p-0">
        <li class="d-flex justify-content-center my-4">
{{--            <h4 class="m-0">MUSIX</h4>--}}
            <img alt="logo" src="/storage/img/logo.svg" class="my-1" width="100"/>
        </li>

        <x-sidebar-item title="Statistikat"
                        link="/statistics"
                        icon="fas fa-chart-line"
                        for-manager="1"></x-sidebar-item>

        <x-sidebar-item title="Përdoruesit"
                        link="/users"
                        icon="fas fa-user"></x-sidebar-item>

        <x-sidebar-item title="Këngët"
                        link="/songs"
                        icon="fas fa-music"
                        for-manager="1"></x-sidebar-item>

        <x-sidebar-item title="Artistët"
                        link="/artists"
                        icon="fas fa-microphone"
                        for-manager="1"></x-sidebar-item>

        <x-sidebar-item title="Zhanret"
                        link="/genres"
                        icon="fas fa-list-ul"
                        for-manager="1"></x-sidebar-item>

        <x-sidebar-item title="Abonimet"
                        link="/subscriptions"
                        icon="fas fa-money-check-alt">
        </x-sidebar-item>

        <x-sidebar-item title="Rolet"
                        link="/roles"
                        icon="fas fa-user-cog">
        </x-sidebar-item>

        <li class="sidebar-item position-absolute w-100 text-center" style="bottom: 20px">
            <form method="POST" action="/logout" id="logout-form">
                @csrf
                <a class="sidebar-link" onclick="document.getElementById('logout-form').submit()">
                    <i class="fas fa-sign-out-alt fa-fw"></i>
                    <span class="ml-2">Çkyçu</span>
                </a>
            </form>
        </li>
    </ul>
</div>
