<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        <div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="mx-auto">
                        <h1>Blog Website</h1>
                    </div>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" wire:navigate href="/">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" wire:navigate href="/register">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        
        {{ $slot }}
    </body>
</html>
