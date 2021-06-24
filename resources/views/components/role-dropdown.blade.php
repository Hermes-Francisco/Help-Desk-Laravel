@props(['roles', 'select'])
<div {{ $attributes->merge(['class' =>"relative flex lg:inline-flex items-center bg-gray-100"]) }}>
    <select name="role" class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold rounded-lg">
        <option disabled selected>Perfil
        </option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{isset($select) && $role->id == $select ? 'selected': ''}}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>
</div>
