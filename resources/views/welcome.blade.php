<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Moçar Restarante</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="antialiased bg-[url('/img/bg_restaurante.jpg')] bg-no-repeat bg-cover bg-center bg-fixed">
    <header class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (Route::has('login'))
            <nav class="relative z-50 flex flex-row-reverse ">
                <div class="flex items-center gap-x-5 md:gap-x-8">
                    @auth
                    <a class="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-green-600 text-white hover:text-slate-100 hover:bg-green-500 active:bg-green-800 active:text-green-100 focus-visible:outline-green-600" href="{{ url('/home') }}">
                        <span>Reservar</span>
                    </a>
                    @else
                    <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('login') }}">Entrar</a>

                    @if (Route::has('register'))
                    <a class="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600" href="{{ route('register') }}">
                        <span>Cadastrar</span>
                    </a>
                    @endif
                    @endauth
                </div>
            </nav>
            @endif
        </div>
    </header>
    <main>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-center">
                        <img class="w-64" src="/img/logo_moçar.png" alt="Restaurante Moçar">
                    </div>
                    <h1 class="text-center text-center text-2xl font-bold">Restaurante Moçar</h1>
                    <p class="text-center text-lg">Venha ao Moçar saborear a excelência culinária: uma experiência irresistível no nosso restaurante!</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
