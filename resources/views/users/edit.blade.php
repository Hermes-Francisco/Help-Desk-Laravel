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

        <form method="POST" action="{{ route('users.update', $user) }}">
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
                <x-jet-button class="ml-4 text-center bg-blue-700">
                    {{ __('Salvar') }}
                </x-jet-button>
            </div>
        </form>
        <hr>
        <div class="w-full text-center" id="opcoes"><a href="#" id="opcao">mais opções</a></div>
        <div id="mais" style="display: none">
            <form method="POST" id="recuperacao" action="{{ route('users.recover', $user) }}">
                @csrf
                @method('PUT')
                <x-jet-button class="text-center mt-4 w-full">
                    {{ __('Enviar email de recuperação') }}
                </x-jet-button>
            </form>

            <x-jet-button class="text-center mt-2 w-full hover:bg-red-300 bg-red-700" id="question_delete">
                {{ __('Deletar') }}
            </x-jet-button>

            <div id="confirm" style="display: none" class="mt-2">
                <h3>Deseja mesmo deletar esse usuário?</h3>
                <form method="POST" action="{{ route('users.delete', $user) }}">
                    @csrf
                    @method('Delete')
                    <x-jet-button class="text-center mt-4 w-full hover:bg-red-500 bg-red-700">
                        {{ __('SIM') }}
                    </x-jet-button>
                </form>

                <x-jet-button id="nao" class="mt-2 text-center w-full hover:bg-green-500 bg-green-700">
                    {{ __('NÃO') }}
                </x-jet-button>

            </div>
            <hr class="mt-4">
            <div class="w-full text-center"><a href="#" id="fechar">ocultar</a></div>
        </div>
        <script src="/js/edit_user.js"></script>
    </x-jet-authentication-card>
</x-app-layout>
