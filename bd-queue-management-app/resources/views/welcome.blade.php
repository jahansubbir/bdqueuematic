<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BD-Counter Queue Management App</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.text-center{text-align:center}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:border-gray-700{--tw-border-opacity: 1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
    <img class='container' src='/images/background.jpg' style='margin:0 auto'/>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                        class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                  <svg class="ign-logo" viewBox="0 0 200 88" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" data-di-res-id="1d3f9f0e-61254a4a" data-di-rand="1696483400390"><g id="Large---1280px-(Max-Width)" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="IGN---Transparent" transform="translate(-104.000000, -21.000000)"><g id="IGN"><g id="Logo" transform="translate(104.000000, 21.000000)"><g id="Text" transform="translate(51.502463, 9.973333)" fill="#FFFFFF"><polyline class="ign-logo__fill" id="Fill-4" points="0.225647399 17.0377015 0.225647399 0.584446483 4.63718082 0.584446483 10.2269671 12.8797823 15.7337777 0.584446483 19.9599991 0.584446483 19.9599991 17.0377015 16.3222127 17.0377015 16.3222127 7.46604648 12.1250328 17.0377015 8.24730872 17.0377015 3.99619469 7.51820061 3.99619469 17.0377015 0.225647399 17.0377015"></polyline><path class="ign-logo__fill" d="M34.599652,10.6673492 L31.5558322,3.69310703 L28.5818502,10.6673492 L34.599652,10.6673492 Z M25.8609436,17.0377015 L21.5828626,17.0377015 L28.9365707,0.584446483 L34.2034438,0.584446483 L41.6097031,17.0377015 L37.386939,17.0377015 L35.9293352,13.7602263 L27.2736024,13.7602263 L25.8609436,17.0377015 L25.8609436,17.0377015 Z" id="Fill-5"></path><polyline class="ign-logo__fill" id="Fill-6" points="43.3155421 17.0377015 43.3155421 0.584446483 59.1445112 0.584446483 59.1445112 3.87427401 47.1386406 3.87427401 47.1386406 7.1421419 57.432449 7.1421419 57.432449 10.353052 47.1386406 10.353052 47.1386406 13.7465015 59.1735527 13.7465015 59.1735527 17.0377015 43.3155421 17.0377015"></polyline><path class="ign-logo__fill" d="M66.1296696,8.13924648 L74.4465856,8.13924648 L74.4465856,3.87427401 L66.1296696,3.87427401 L66.1296696,8.13924648 Z M62.252637,17.0377015 L62.252637,0.584446483 L75.4983007,0.584446483 C77.2677543,0.584446483 78.2952682,1.60076575 78.2952682,3.34381162 L78.2952682,8.871463 C78.2952682,10.143063 77.1605776,11.2925125 74.961034,11.2925125 C74.8365707,11.2986887 74.7093415,11.2925125 74.578655,11.2925125 L78.4342523,17.0377015 L74.1789895,17.0377015 L70.523225,11.411918 L66.1296696,11.411918 L66.1296696,17.0377015 L62.252637,17.0377015 L62.252637,17.0377015 Z" id="Fill-7"></path><path class="ign-logo__fill" d="M85.2700547,17.0473089 L83.9576581,17.0473089 C82.244213,17.0473089 81.4192977,16.0646153 81.4192977,14.633808 L81.4192977,12.4845089 L85.2700547,12.4845089 L85.2700547,13.7574813 L93.4521354,13.7574813 L93.4521354,10.3894226 C93.4521354,10.3894226 85.5646179,10.3894226 84.0669092,10.3894226 C82.5685091,10.3894226 81.4891354,9.38957309 81.4891354,8.00199878 L81.4891354,3.11735291 C81.4891354,1.63919511 82.6639309,0.594740061 84.0931848,0.594740061 C85.5217472,0.594740061 94.8219234,0.594740061 94.8219234,0.594740061 C96.2719212,0.594740061 97.2752339,1.66870336 97.2752339,3.22166116 C97.2752339,4.77256024 97.2752339,5.1849896 97.2752339,5.1849896 L93.4521354,5.1849896 L93.4521354,3.88456758 L85.2700547,3.88456758 L85.2700547,7.12498593 L94.6283138,7.12498593 C96.0098567,7.12498593 97.2752339,8.03219327 97.2752339,9.77867034 L97.2752339,14.4746006 C97.2752339,16.0742226 96.3811723,17.0473089 94.709215,17.0473089 C93.0372576,17.0473089 85.2700547,17.0473089 85.2700547,17.0473089" id="Fill-8"></path><polyline class="ign-logo__fill" id="Fill-9" points="100.970412 17.0473089 100.970412 0.592681346 104.900687 0.592681346 104.900687 7.17370887 112.387156 0.592681346 117.708655 0.592681346 108.77772 8.23600612 118.030185 17.0473089 112.520608 17.0473089 104.900687 9.56319144 104.900687 17.0473089 100.970412 17.0473089"></polyline></g><g id="Star" fill-rule="nonzero"><path d="M4.28463565,0 L31.3468062,0 C33.7169495,0 35.6383302,1.91076181 35.6383302,4.26780595 L35.6383302,33.132194 C35.6383302,35.4892382 33.7169495,37.4 31.3468062,37.4 L4.28463565,37.4 C1.91830905,37.4 0,35.4923151 0,33.1390665 L0,4.27467843 C-0.00365105909,3.142229 0.446140088,2.05490945 1.25005944,1.25285417 C2.0539788,0.450798892 3.14588678,0 4.28463565,0 Z" id="Shape" fill="#42B0D5"></path><polygon id="Shape" fill="#FFFFFF" points="23.4962889 17.6509756 30.5313476 8.91442683 30.5106156 8.88706098 20.3450249 13.7308171 17.8364529 2.84604878 17.7949889 2.84604878 15.2864169 13.7308171 5.12082631 8.88706098 5.10009431 8.91442683 12.135153 17.6509756 1.96956232 22.4947317 1.98338365 22.528939 13.2615916 22.528939 10.7530196 33.4205488 10.7806623 33.4342317 17.8157209 24.6976829 24.8507796 33.4342317 24.8853329 33.4137073 22.3698503 22.528939 33.6549689 22.528939 33.6618796 22.4947317"></polygon></g></g></g></g></g></svg>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div>
                           

                            
                        </div>

                      
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center"
                        style="background-image: url('/images/background.jpg');">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /> -->
                            </svg>

                           
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        <!-- Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
