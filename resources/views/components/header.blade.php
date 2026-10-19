<header class="mt-4 flex justify-end">
    <nav>
        <ul class="flex items-stretch gap-2">
            <li>
                <a href="#" class="block p-1 bg-yellow-300 border-4 border-transparent border-b-black border-r-black hover:-translate-y-1">
                    <svg class="size-9" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M14 20h2v2H4v-2h8v-6h2v6ZM4 20H2V10h2v10Zm14 0h-2v-2h2v2Zm2-2h-2v-2h2v2Zm2-2h-2v-2h-6v-2h6V4h2v12ZM6 4h2v2H6v2H4V6H2V4h2V2h2v2Zm14 0H10V2h10v2Z"></path></svg>
                </a>
            </li>
            <li>
                <a href="{{ auth()->check() ? route('profile.index', auth()->user()) : route('auth.google.redirect') }}" class="block p-1 bg-yellow-300 border-4 border-transparent border-b-black border-r-black hover:-translate-y-1">
                    <svg class="size-9" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M6 22H4v-4h2v4Zm14 0h-2v-4h2v4ZM8 18H6v-2h2v2Zm10 0h-2v-2h2v2Zm-2-2H8v-2h8v2Zm-1-4H9v-2h6v2Zm-6-2H7V4h2v6Zm8 0h-2V4h2v6Zm-2-6H9V2h6v2Z"/></svg>
                </a>
            </li>
        </ul>
    </nav>
</header>