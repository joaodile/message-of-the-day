<x-layout>
    <x-slot:page-title>Mensagem do Dia | joaodile.dev</x-slot>
    
    <div class="container px-2 sm:mx-auto min-h-screen flex flex-col gap-8">
        <x-header />

        <main class="grow flex items-center justify-center flex-col gap-1 max-md:max-w-sm mx-auto max-sm:min-h-[70vh]">
            <h1 class="font-title text-center text-4xl md:text-6xl">
                @auth
                    Olá, {{ auth()->user()->name }}!
                @else
                    Mensagem do
                    <span>dia</span>
                @endauth
            </h1>
            @guest
                <p class="text-center">
                    Você pode escrever a sua mensagem após entrar na sua conta
                </p>
            @endguest
            <div class="flex max-md:flex-col items-center md:gap-4 mt-2">
                @auth
                    <a href="#" class="mt-1 flex items-center w-fit gap-2 p-2 px-4 bg-yellow-300 border-4 border-transparent border-b-black border-r-black hover:-translate-y-1 font-title">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M14 20h2v2H4v-2h8v-6h2v6ZM4 20H2V10h2v10Zm14 0h-2v-2h2v2Zm2-2h-2v-2h2v2Zm2-2h-2v-2h-6v-2h6V4h2v12ZM6 4h2v2H6v2H4V6H2V4h2V2h2v2Zm14 0H10V2h10v2Z"></path></svg>
                        Escrever
                    </a>
                @else
                    <a href="{{ route('auth.google.redirect') }}" class="mt-1 flex items-center w-fit gap-2 p-2 px-4 bg-yellow-300 border-4 border-transparent border-b-black border-r-black hover:-translate-y-1 font-title">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M17 21H7v-2h10v2ZM7 19H5v-2h2v2Zm12 0h-2v-2h2v2ZM5 17H3V7h2v10Zm16 0h-2v-4h-6v-2h8v6ZM7 7H5V5h2v2Zm12 0h-2V5h2v2Zm-2-2H7V3h10v2Z"/></svg>
                        Entrar
                    </a>
                @endauth
                <p>ou</p>
                <a href="#" class="mt-1 flex items-center w-fit gap-2 p-2 px-4 hover:bg-yellow-300 border-4 border-black font-title hover:-translate-y-1">
                    <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M20 20H4v-2h16v2ZM4 18H2V6h2v12Zm18 0h-2v-8h2v8Zm-8-4h-4v-2h4v2Zm-4-2H8v-2h2v2Zm6 0h-2v-2h2v2Zm-8-2H6V8h2v2Zm12-2h-2V6h2v2Zm-6-2H4V4h10v2Zm4 0h-2V4h2v2Zm4 0h-2V4h2v2Zm-2-2h-2V2h2v2Z"></path></svg>
                    Ver mensagens
                </a>
            </div>
        </main>

        <x-footer />
    </div>
</x-layout>