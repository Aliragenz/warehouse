<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Topbar Navbar -->
    <h4>Account: {{ Auth::user()->accountName }}!</h4>
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger" type="submit">{{ __('Log Out') }}</button>
            </form>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
