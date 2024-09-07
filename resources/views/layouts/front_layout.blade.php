<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Front Page</title>
    @stack('custom_css')
</head>
<body>
    <div x-data="translationHandler()">
        <header>
            @include('frontpage.partials.navbar')
        </header>
            <button @click="changeLanguage('en')">English</button>
            <button @click="changeLanguage('kh')">ភាសាខ្មែរ</button>

            <p x-text="messages.welcome"></p>
            <p x-text="messages.greeting.replace(':name', 'John')"></p>

        <main>
            @yield('content')
        </main>
        <sidebar>
            @yield('sidebar')
        </sidebar>

        <footer>
            @include('frontpage.partials.footer')
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        function translationHandler() {
            return {
                messages: {},
                changeLanguage(locale) {
                    fetch(`/translations/${locale}`)
                        .then(response => response.json())
                        .then(data => {
                            this.messages = data.messages;
                        });
                },
                init() {
                    this.changeLanguage('en'); // Load default language on init
                }
            }
        }
    </script>

    @stack('custom_js')
    @stack('crud_js')
</body>
</html>


