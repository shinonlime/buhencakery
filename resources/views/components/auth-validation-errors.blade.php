@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        {{-- <div class="font-medium text-red-600">
            {{ __('Whoops! Something went wrong.') }}
        </div> --}}

        <div class="mt-3 text-sm text-red-600 text-center">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    </div>
@endif
