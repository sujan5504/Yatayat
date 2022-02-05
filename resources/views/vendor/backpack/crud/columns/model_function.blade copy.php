{{-- custom return value --}}
@php
	$value = $entry->{$column['function_name']}(...($column['function_parameters'] ?? []));
	// dd($value);
@endphp

<span>
	{!! nl2br((array_key_exists('prefix', $column) ? $column['prefix'] : '').str_limit($value, array_key_exists('limit', $column) ? $column['limit'] : 200, "[...]").(array_key_exists('suffix', $column) ? $column['suffix'] : '')) !!}
</span>