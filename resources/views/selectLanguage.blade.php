
<x-guest-layout>
    <form method="POST" action="{{ route('storeLanguage') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('username')" />
            <x-text-input id="username" class="block mt-1 w-full @error('username') is-invalid @enderror" type="text" name="username" :value="old('username')" autofocus  />
                @if ($errors->has('username'))
                <div class="text-danger">{{ $errors->first('username') }}</div>
            @endif
        </div>
        <!-- Select Languages -->
        <div>
            <x-input-label class="mt-5"  for="language" :value="__('language')" />
            <select id="language" class="block mt-1 w-full @error('language') is-invalid @enderror" name="language" autofocus autocomplete="language">
                <option value="">Select Language</option>
                @foreach ($languages as $language)
                <option {{old('language') == $language->id ? 'selected' : '' }} value="{{$language->id}}">{{$language->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('language'))
             <div class="text-danger">{{ $errors->first('language') }}</div>
             @endif
        </div>
 
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Next') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>