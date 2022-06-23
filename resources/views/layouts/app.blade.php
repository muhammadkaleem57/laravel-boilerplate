<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <script src="{{ mix('js/app.js') }}" defer></script>

        @stack('styles')
    </head>
    <body>
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main class="container my-5">

            @include('components.session-messages')

            {{ $slot }}
        </main>

        <livewire:components.toaster/>
        <livewire:components.event-listener/>
        <livewire:components.modal/>
        <livewire:components.confirmation-modal/>

        @stack('modals')

        @livewireScripts

        @stack('scripts')
    </body>
</html>
