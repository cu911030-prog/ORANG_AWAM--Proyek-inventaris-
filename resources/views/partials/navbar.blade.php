<div class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-4">
                <button class="lg:hidden inline-flex items-center justify-center p-2 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 4h14a1 1 0 010 2H3a1 1 0 010-2zm0 4h14a1 1 0 010 2H3a1 1 0 010-2z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="text-sm font-medium text-slate-700">Welcome back, {{ Auth::user()->name }}</div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('profile.edit') }}" class="text-sm text-slate-600 hover:text-slate-900">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-slate-600 hover:text-slate-900">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
