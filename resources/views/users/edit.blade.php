<x-app-layout>
    <div class="w-full h-1 shadow"></div>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('invitation.store') }}">
            @csrf
            @method('PUT')

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required />
            </div>

            <div class="flex items-center mt-8 mb-4">
                <x-role-dropdown :roles="$roles" :select="$user->role->id" class="flex-1" />
                <x-jet-button class="ml-4 text-center">
                    {{ __('Salvar') }}
                </x-jet-button>
            </div>
        </form>
        <hr>
        <div class="w-full text-center" id="opcoes"><a href="#" id="opcao">mais opções</a></div>
        <div id="mais" style="display: none">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <x-jet-button class="text-center w-full">
                    {{ __('Enviar email de recuperação') }}
                </x-jet-button>
            </form>

            <x-jet-button class="text-center w-full" id="question_delete">
                {{ __('Deletar') }}
            </x-jet-button>

            <div id="confirm" style="display: none">
                <form method="POST" action="{{ route('users.delete', $user) }}">
                    @csrf
                    @method('Delete')
                    <x-jet-button class="text-center w-full bg-red-500">
                        {{ __('SIM') }}
                    </x-jet-button>
                </form>

                <x-jet-button class="text-center w-full bg-green-500">
                    {{ __('NÃO') }}
                </x-jet-button>

            </div>
        </div>
        <script src="/js/edit_user.js"></script>
    </x-jet-authentication-card>
</x-app-layout>
