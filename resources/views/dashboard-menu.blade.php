<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                @can('create_action')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link
                            href="/?todas=1&{{ http_build_query(request()->except(['author', 'responsible', 'page'])) }}"
                            :active="request()->query('todas') == 1"
                            >
                            {{ __('Todas') }}
                        </x-jet-nav-link>
                    </div>
                @endcan
                @can('edit_responsibility')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link
                            href="/?responsible=none&{{ http_build_query(request()->except(['todas','author', 'responsible', 'page'])) }}"
                            :active="request()->query('responsible') == 'none'"
                            >
                            {{ __('Sem responsável') }}
                        </x-jet-nav-link>
                    </div>
                @endcan
                @can('create_action')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link
                            href="/?responsible={{request()->user()->id}}&{{ http_build_query(request()->except(['todas','author', 'responsible', 'page'])) }}"
                            :active="request()->query('responsible') == request()->user()->id"
                            >
                            {{ __('Recebidos') }}
                        </x-jet-nav-link>
                    </div>
                @endcan

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link
                        href="/?author={{request()->user()->id}}&{{ http_build_query(request()->except(['todas','author', 'responsible', 'page'])) }}"
                        :active="request()->query('author') == request()->user()->id"
                        >
                        {{ __('Criados por mim') }}
                    </x-jet-nav-link>
                </div>

                <h3 class="mt-5 font-bold ml-10">Status:</h3>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link
                        href="/?status=todos&{{ http_build_query(request()->except(['status', 'page'])) }}"
                        :active="request()->query('status') == 'todos'"
                        >
                        {{ __('Todos') }}
                    </x-jet-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link
                        href="/?status=to do&{{ http_build_query(request()->except(['status', 'page'])) }}"
                        :active="request()->query('status') == 'to do'"
                        >
                        {{ __('A fazer') }}
                    </x-jet-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link
                        href="/?status=in progress&{{ http_build_query(request()->except(['status', 'page'])) }}"
                        :active="request()->query('status') == 'in progress'"
                        >
                        {{ __('Em progresso') }}
                    </x-jet-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link
                        href="/?status=delayed&{{ http_build_query(request()->except(['status', 'page'])) }}"
                        :active="request()->query('status') == 'delayed'"
                        >
                        {{ __('Atrazados') }}
                    </x-jet-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link
                        href="/?status=done&{{ http_build_query(request()->except(['status', 'page'])) }}"
                        :active="request()->query('status') == 'done'"
                        >
                        {{ __('Concluídos') }}
                    </x-jet-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>
