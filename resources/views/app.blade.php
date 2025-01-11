<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- Windows -->
    <link rel="icon" sizes="71x71" href="/pwa/icons/windows11/SmallTile.scale-100.png">
    <link rel="icon" sizes="89x89" href="/pwa/icons/windows11/SmallTile.scale-125.png">
    <link rel="icon" sizes="107x107" href="/pwa/icons/windows11/SmallTile.scale-150.png">
    <link rel="icon" sizes="142x142" href="/pwa/icons/windows11/SmallTile.scale-200.png">
    <link rel="icon" sizes="284x284" href="/pwa/icons/windows11/SmallTile.scale-400.png">
    <link rel="icon" sizes="150x150" href="/pwa/icons/windows11/Square150x150Logo.scale-100.png">
    <link rel="icon" sizes="188x188" href="/pwa/icons/windows11/Square150x150Logo.scale-125.png">
    <link rel="icon" sizes="225x225" href="/pwa/icons/windows11/Square150x150Logo.scale-150.png">
    <link rel="icon" sizes="300x300" href="/pwa/icons/windows11/Square150x150Logo.scale-200.png">
    <link rel="icon" sizes="600x600" href="/pwa/icons/windows11/Square150x150Logo.scale-400.png">
    <link rel="icon" sizes="310x150" href="/pwa/icons/windows11/Wide310x150Logo.scale-100.png">
    <link rel="icon" sizes="388x188" href="/pwa/icons/windows11/Wide310x150Logo.scale-125.png">
    <link rel="icon" sizes="465x225" href="/pwa/icons/windows11/Wide310x150Logo.scale-150.png">
    <link rel="icon" sizes="620x300" href="/pwa/icons/windows11/Wide310x150Logo.scale-200.png">
    <link rel="icon" sizes="1240x600" href="/pwa/icons/windows11/Wide310x150Logo.scale-400.png">
    <link rel="icon" sizes="310x310" href="/pwa/icons/windows11/LargeTile.scale-100.png">
    <link rel="icon" sizes="388x388" href="/pwa/icons/windows11/LargeTile.scale-125.png">
    <link rel="icon" sizes="465x465" href="/pwa/icons/windows11/LargeTile.scale-150.png">
    <link rel="icon" sizes="620x620" href="/pwa/icons/windows11/LargeTile.scale-200.png">
    <link rel="icon" sizes="1240x1240" href="/pwa/icons/windows11/LargeTile.scale-400.png">
    <link rel="icon" sizes="44x44" href="/pwa/icons/windows11/Square44x44Logo.scale-100.png">
    <link rel="icon" sizes="55x55" href="/pwa/icons/windows11/Square44x44Logo.scale-125.png">
    <link rel="icon" sizes="66x66" href="/pwa/icons/windows11/Square44x44Logo.scale-150.png">
    <link rel="icon" sizes="88x88" href="/pwa/icons/windows11/Square44x44Logo.scale-200.png">
    <link rel="icon" sizes="176x176" href="/pwa/icons/windows11/Square44x44Logo.scale-400.png">
    <link rel="icon" sizes="50x50" href="/pwa/icons/windows11/StoreLogo.scale-100.png">
    <link rel="icon" sizes="63x63" href="/pwa/icons/windows11/StoreLogo.scale-125.png">
    <link rel="icon" sizes="75x75" href="/pwa/icons/windows11/StoreLogo.scale-150.png">
    <link rel="icon" sizes="100x100" href="/pwa/icons/windows11/StoreLogo.scale-200.png">
    <link rel="icon" sizes="200x200" href="/pwa/icons/windows11/StoreLogo.scale-400.png">
    <link rel="icon" sizes="620x300" href="/pwa/icons/windows11/SplashScreen.scale-100.png">
    <link rel="icon" sizes="775x375" href="/pwa/icons/windows11/SplashScreen.scale-125.png">
    <link rel="icon" sizes="930x450" href="/pwa/icons/windows11/SplashScreen.scale-150.png">
    <link rel="icon" sizes="1240x600" href="/pwa/icons/windows11/SplashScreen.scale-200.png">
    <link rel="icon" sizes="2480x1200" href="/pwa/icons/windows11/SplashScreen.scale-400.png">
    <link rel="icon" sizes="16x16" href="/pwa/icons/windows11/Square44x44Logo.targetsize-16.png">
    <link rel="icon" sizes="20x20" href="/pwa/icons/windows11/Square44x44Logo.targetsize-20.png">
    <link rel="icon" sizes="24x24" href="/pwa/icons/windows11/Square44x44Logo.targetsize-24.png">
    <link rel="icon" sizes="30x30" href="/pwa/icons/windows11/Square44x44Logo.targetsize-30.png">
    <link rel="icon" sizes="32x32" href="/pwa/icons/windows11/Square44x44Logo.targetsize-32.png">
    <link rel="icon" sizes="36x36" href="/pwa/icons/windows11/Square44x44Logo.targetsize-36.png">
    <link rel="icon" sizes="40x40" href="/pwa/icons/windows11/Square44x44Logo.targetsize-40.png">
    <link rel="icon" sizes="44x44" href="/pwa/icons/windows11/Square44x44Logo.targetsize-44.png">
    <link rel="icon" sizes="48x48" href="/pwa/icons/windows11/Square44x44Logo.targetsize-48.png">
    <link rel="icon" sizes="60x60" href="/pwa/icons/windows11/Square44x44Logo.targetsize-60.png">
    <link rel="icon" sizes="64x64" href="/pwa/icons/windows11/Square44x44Logo.targetsize-64.png">
    <link rel="icon" sizes="72x72" href="/pwa/icons/windows11/Square44x44Logo.targetsize-72.png">
    <link rel="icon" sizes="80x80" href="/pwa/icons/windows11/Square44x44Logo.targetsize-80.png">
    <link rel="icon" sizes="96x96" href="/pwa/icons/windows11/Square44x44Logo.targetsize-96.png">
    <link rel="icon" sizes="256x256" href="/pwa/icons/windows11/Square44x44Logo.targetsize-256.png">

    <!-- Android -->
    <link rel="icon" sizes="36x36" href="/pwa/icons/android/android-36x36.png">
    <link rel="icon" sizes="48x48" href="/pwa/icons/android/android-48x48.png">
    <link rel="icon" sizes="72x72" href="/pwa/icons/android/android-72x72.png">
    <link rel="icon" sizes="96x96" href="/pwa/icons/android/android-96x96.png">
    <link rel="icon" sizes="144x144" href="/pwa/icons/android/android-144x144.png">
    <link rel="icon" sizes="192x192" href="/pwa/icons/android/android-192x192.png">
    <link rel="icon" sizes="512x512" href="/pwa/icons/android/android-512x512.png">
    <link rel="icon" sizes="1024x1024" href="/pwa/icons/android/android-1024x1024.png">

    <!-- iOS -->
    <link rel="apple-touch-icon" sizes="16x16" href="/pwa/icons/ios/16.png">
    <link rel="apple-touch-icon" sizes="20x20" href="/pwa/icons/ios/20.png">
    <link rel="apple-touch-icon" sizes="29x29" href="/pwa/icons/ios/29.png">
    <link rel="apple-touch-icon" sizes="32x32" href="/pwa/icons/ios/32.png">
    <link rel="apple-touch-icon" sizes="40x40" href="/pwa/icons/ios/40.png">
    <link rel="apple-touch-icon" sizes="50x50" href="/pwa/icons/ios/50.png">
    <link rel="apple-touch-icon" sizes="57x57" href="/pwa/icons/ios/57.png">
    <link rel="apple-touch-icon" sizes="58x58" href="/pwa/icons/ios/58.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/pwa/icons/ios/60.png">
    <link rel="apple-touch-icon" sizes="64x64" href="/pwa/icons/ios/64.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/pwa/icons/ios/72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/pwa/icons/ios/76.png">
    <link rel="apple-touch-icon" sizes="80x80" href="/pwa/icons/ios/80.png">
    <link rel="apple-touch-icon" sizes="87x87" href="/pwa/icons/ios/87.png">
    <link rel="apple-touch-icon" sizes="100x100" href="/pwa/icons/ios/100.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/pwa/icons/ios/114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/pwa/icons/ios/120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/pwa/icons/ios/144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/pwa/icons/ios/152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/pwa/icons/ios/167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/pwa/icons/ios/180.png">
    <link rel="apple-touch-icon" sizes="192x192" href="/pwa/icons/ios/192.png">
    <link rel="apple-touch-icon" sizes="256x256" href="/pwa/icons/ios/256.png">
    <link rel="apple-touch-icon" sizes="512x512" href="/pwa/icons/ios/512.png">
    <link rel="apple-touch-icon" sizes="1024x1024" href="/pwa/icons/ios/1024.png">

    <link rel="apple-touch-startup-image" sizes="1024x1024" href="/pwa/icons/ios/1024.png">
    <link rel="apple-touch-startup-image" sizes="512x512" href="/pwa/icons/ios/512.png">
    <link rel="apple-touch-startup-image" sizes="256x256" href="/pwa/icons/ios/256.png">
    <link rel="apple-touch-startup-image" sizes="192x192" href="/pwa/icons/ios/192.png">

    <link rel="icon" href="{{ url('assets/img/logo.ico') }}">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body>
    @inertia
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>

</body>

</html>
