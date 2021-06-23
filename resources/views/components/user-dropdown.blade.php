<div {{ $attributes->merge(['class' =>"relative flex lg:inline-flex items-center bg-gray-100"]) }}>
    <input name="responsible" list="user" class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 border border-black text-sm font-semibold rounded-lg"
    placeholder="{{ $slot }}"
    >
    <datalist id="user">
        @foreach ($users as $user)
            <option value="{{ $user->id }} - {{ $user->name }}"></option>
        @endforeach
    </datalist>
</div>
