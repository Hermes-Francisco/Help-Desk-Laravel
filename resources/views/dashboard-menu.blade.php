<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('ticket.create') }}" :active="request()->routeIs('ticket.create')">
                        {{ __('Criar chamado') }}
                    </x-jet-nav-link>
                </div>
                @can('create_users')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                            {{ __('Lista de usuários') }}
                        </x-jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('invitation.create') }}" :active="request()->routeIs('invitation.create')">
                            {{ __('Cadastrar usuário') }}
                        </x-jet-nav-link>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</nav>
