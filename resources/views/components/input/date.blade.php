<div
x-data
x-init="new Pikaday({ field: $refs.input, format: 'DD/MM/YYYY',theme: 'dark' })"
@change="$dispatch('input', $event.target.value)"
class="flex"
>

<input
    {{ $attributes }}
    readonly
    x-ref="input"
/>
</div> 
