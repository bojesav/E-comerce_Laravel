<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite(['resources/css/app.css','resource/js/app.js'])
        @vite('resources/js/app.js')
    </head>
    <body class=" bg-slate-200 dark:bg-slate-700">
        @livewire('partial.navbar')
        <main>
            {{ $slot }}
</main>
@livewire('partial.footer')
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <x-livewire-alert::scripts />
    </body>
</html>
