<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li><a class="waves-effect waves-dark" href="{!! url('dashboard') !!}" aria-expanded="false">
                <i class="mdi mdi-home"></i>
                <span class="hide-menu">{{ trans('lang.dashboard') }}</span>
            </a>
        </li>
    </ul>
    <ul id="sidebarnav">
        <li>
            <a class="waves-effect waves-dark" href="{!! url('earnings') !!}" aria-expanded="false">
                <i class="mdi mdi-cash-multiple"></i>
                <span class="hide-menu">Paiements &amp; Gains</span>
            </a>
        </li>
    </ul>
    <p class="web_version"></p>
</nav>
