<x-layouts.admin title="Login">
    <div class="grid min-h-[80vh] place-items-center">
        <div class="w-full max-w-md">
            <div class="mb-8 flex flex-col items-center text-center">
                <x-brand-icon id="login" class="size-16" />
                <h1 class="mt-4 text-2xl font-semibold">Admin login</h1>
                <p class="mt-1 text-sm text-slate-500">Sign in to view website enquiries</p>
            </div>
            <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5 rounded-3xl border border-slate-200 bg-white p-7 shadow-xl shadow-navy-900/5">
                @csrf
                <div>
                    <label for="email" class="field-label">Email</label>
                    <input id="email" name="email" type="email" required autofocus autocomplete="username" value="{{ old('email') }}" class="field">
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password" class="field-label">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="field">
                    @error('password')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1" class="size-4 rounded accent-navy-900"> Keep me signed in
                </label>
                <button type="submit" class="btn btn-navy w-full">Sign in <i data-lucide="arrow-right" class="size-4"></i></button>
            </form>
        </div>
    </div>
</x-layouts.admin>
