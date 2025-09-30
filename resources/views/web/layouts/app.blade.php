<!DOCTYPE html>
<html lang="en">

<head>
    @include('web.layouts.partials.head')
</head>

<body class="bg-soft-primary">
    <div class="content-wrapper">
        
        @include('web.layouts.partials.navbar')

        {{-- Ini adalah tempat untuk konten spesifik per halaman --}}
        <main>
            @yield('content')
        </main>

    </div>
    @include('web.layouts.partials.footer')
    
    @include('web.layouts.partials.foot')

</body>

</html>