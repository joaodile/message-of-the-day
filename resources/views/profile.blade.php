<x-layout>
    <x-slot:page-title>Mensagem do Dia | Perfil de &#64;{{ $user->handle }}</x-slot>
    
    <div class="container px-2 sm:mx-auto min-h-screen flex flex-col gap-8">
        <x-header />

        <main class="grow flex flex-col gap-1 max-sm:min-h-[70vh]">
            <section class="max-w-3xl mx-auto my-12">
                <div class="flex items-center md:items-start justify-center max-md:flex-col gap-8">
                    <img 
                        class="border-5 border-black w-37.5 aspect-square bg-center"
                        src="https://placehold.co/150x150/ffdf20/black?text={{ urlencode($user->name) }}" 
                        alt="Foto de perfil de {{ $user->name }}"
                    >
                    <div class="flex flex-col gap-2 max-md:items-center">
                        <h1 class="font-title text-5xl">
                            {{ $user->name }}
                        </h1>
                        <p class="text-sm mt-2 max-md:text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem quod eaque beatae voluptatibus sequi id explicabo commodi iste consectetur possimus!</p>
                        @if(auth()->guest() || auth()->user()->isNot($user))
                            <a href="#" class="mt-1 flex items-center w-fit gap-2 p-2 px-4 border-2 border-black hover:bg-yellow-300 font-title">
                                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M18 22H6v-2h12v2ZM6 20H4v-2h2v2Zm14 0h-2v-2h2v2ZM4 18H2V6h2v12Zm18 0h-2v-8h2v8Zm-7-1H9v-2h6v2Zm-6-2H7v-2h2v2Zm8 0h-2v-2h2v2Zm-7-5H8V8h2v2Zm6 0h-2V8h2v2Zm4-6h2v2h-2v2h-2V6h-2V4h2V2h2v2ZM6 6H4V4h2v2Zm8-2H6V2h8v2Z"></path></svg>
                                Seguir
                            </a>
                        @endif
                    </div>
                </div>
                <ul class="mt-4 flex items-stretch flex-wrap gap-2">
                    @if(auth()->user()?->is($user))
                        <li>
                            <a href="#" class="mt-1 flex items-center w-fit gap-2 p-2 px-4 bg-yellow-300 border-4 border-transparent border-b-black border-r-black hover:-translate-y-1 font-title">
                                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M5 20h3v2H3v-6h2v4Zm16 2h-5v-2h3v-4h2v6Zm-11-2H8v-2h2v2Zm6 0h-2v-2h2v2Zm-2-2h-4v-2h4v2Zm-7-2H5v-3h2v3Zm12 0h-2v-3h2v3ZM5 13H3v-2h2v2Zm16 0h-2v-2h2v2ZM9 9H3v2H1V7h8v2Zm14 2h-2V9h-6V7h8v4ZM11 7H9V3h2v4Zm4 0h-2V3h2v4Zm-2-4h-2V1h2v2Z"/></svg>
                                Favoritos
                            </a>
                        </li>

                        <li class="sm:ms-auto">
                            <a href="#" class="mt-1 flex items-center w-fit gap-2 p-2 px-4 bg-yellow-300 border-4 border-transparent border-b-black border-r-black hover:-translate-y-1 font-title">
                                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M4 20h3v-2h4v4h2v-4h4v2h-2v4H9v-4H7v2H2v-5h2v3Zm18 2h-5v-2h3v-3h2v5ZM6 11H2v2h4v4H4v-2H0V9h4V7h2v4Zm14-2h4v6h-4v2h-2v-4h4v-2h-4V7h2v2Zm-6 7h-4v-2h4v2Zm-4-2H8v-4h2v4Zm6 0h-2v-4h2v4Zm-2-4h-4V8h4v2ZM7 4H4v3H2V2h5v2Zm8 0h2V2h5v5h-2V4h-3v2h-4V2h-2v4H7V4h2V0h6v4Z"/></svg>
                                Configurações
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('auth.logout') }}" class="mt-1 flex items-center w-fit gap-2 p-2 px-4 bg-yellow-300 border-4 border-transparent border-b-black border-r-black hover:-translate-y-1 font-title">
                                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M18 22H6v-2h12v2ZM6 20H4V4h2v16Zm14 0h-2v-3h2v3ZM16 9h2v2h2v2h-2v2h-2v2h-2v-4H8v-2h6V7h2v2Zm4-2h-2V4h2v3Zm-2-3H6V2h12v2Z"/></svg>
                                Sair
                            </a>
                        </li>
                    @endif
                </ul>   
            </section>

            <section class="columns-3 gap-8">
                @for($i = 0; $i < 20; $i++)
                    <article class="not-first:mt-8 break-inside-avoid bg-zinc-50 p-5 border-2 border-transparent border-b-black border-r-black">
                        <h1>{{ $i }}. {{ fake()->words(mt_rand(10, 30), true) }}</h1>
                        <img 
                            class="w-full aspect-video bg-center bg-cover mt-4"
                            src="{{ cache()->remember('dev-card-image-' . $i, now()->addDay(), fn() => 'https://placehold.co/1280x720/ffdf20/black?text=' . urlencode(fake()->words(5, true))) }}" 
                            alt="Imagem da postagem"
                        >
                    </article>
                @endfor
            </section>
        </main>

        <x-footer />
    </div>
</x-layout>