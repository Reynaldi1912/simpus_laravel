<li class="list-inline-item">
    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
    <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
        <i class="si si-drop"></i>
    </a>
</li>
<li class="list-inline-item">
    <a class="link-effect text-dual-primary-dark" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <!-- {{ __('Logout') }} -->
        <i class="si si-logout mr-5"></i>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</li>