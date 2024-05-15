    @include('layouts.header')

    <div>
        @include('layouts.nav')

        <main>
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')
