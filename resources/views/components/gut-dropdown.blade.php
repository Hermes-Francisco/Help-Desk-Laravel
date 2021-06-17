@props(['name'])
<div {{ $attributes->merge(['class' =>"relative flex lg:inline-flex items-center bg-gray-100"]) }}>
    <select class="appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold rounded-lg" name="{{$name}}">
        <option disabled selected>{{$slot}}
        </option>
        <option value="1">1 Nenhuma</option>
        <option value="2">2 Baixa</option>
        <option value="3">3 Média</option>
        <option value="4">4 Alta</option>
        <option value="5">5 Muito Alta</option>
    </select>
</div>
