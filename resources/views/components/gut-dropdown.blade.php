@props(['name', 'value'])
<?php $selected = null; if(isset($value))$selected=$value ?>
<div {{ $attributes->merge(['class' =>"relative flex lg:inline-flex items-center bg-gray-100"]) }}>
    <select class="appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold rounded-lg" name="{{$name}}">
        <option disabled
            @unless (isset($value))
                selected
            @endunless
        >{{$slot}}
        </option>
        <option value="1" {{ ($selected == 1)? 'selected' : ''}}>1 Nenhuma</option>
        <option value="2" {{ ($selected == 2)? 'selected' : ''}}>2 Baixa</option>
        <option value="3" {{ ($selected == 3)? 'selected' : ''}}>3 Média</option>
        <option value="4" {{ ($selected == 4)? 'selected' : ''}}>4 Alta</option>
        <option value="5" {{ ($selected == 5)? 'selected' : ''}}>5 Muito Alta</option>
    </select>
</div>
