{{-- <x-guest-layout> --}}
{{-- <form method="POST" action="{{ route('storeLanguage') }}">
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
    </form> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Language</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <div class="logoContainer">
                <img class="logo" src="{{ asset('ChatScribe.png') }}" alt="logo">
            </div>
            <div class="taglineContainer">
                <p class="tagline">Empowering Conversations Across Languages.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('storeLanguage') }}">
            @csrf
            <div class=" userNameContainer">
                {{-- <input class="userInput" placeholder="Enter Your Unique Username Here" type="text"> --}}
                <input type="text" id="username" class="form-control userInput" name="username" value="{{old('username')}}" autofocus placeholder="Enter Your Unique Username Here">
            </div>
            @if ($errors->has('username'))
                <div style="color: red; margin-left:25px;margin-top:10px;" class="text-danger  ">{{ $errors->first('username') }}</div>
            @endif
            <div class="selectContainer">
                <select id="language"  class="selectt block mt-1 w-full @error('language') is-invalid @enderror"
                    name="language" autofocus autocomplete="language">
                    <option value="">Select Language</option>
                    @foreach ($languages as $language)
                        <option {{ old('language') == $language->id ? 'selected' : '' }} value="{{ $language->id }}">
                            {{ $language->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('language'))
                <div style="color: red ; margin-left:25px; " class="text-danger">{{ $errors->first('language') }}</div>
            @endif
            <div class="selectContainer">
                <p class="para">The language in which you'd like to receive messages.</p>
            </div>
            <div class="btnContainer">
                <button class="btn" type="submit">Proceed</button>
                
            </div>
        </form>
    </div>

    <script>
        // Add an event listener to toggle the open attribute of the details element when an item is clicked
        const languageSelect = document.getElementById('languageSelect');
        const items = languageSelect.querySelectorAll('input[type="radio"]');

        items.forEach(item => {
            item.addEventListener('click', () => {
                languageSelect.open = !languageSelect.open;
            });
        });
    </script>
</body>

</html>
