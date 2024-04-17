  @if (in_array('Staff', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
      <x-app-layout>

          <style>
              [x-cloak] {
                  display: none !important;
              }
          </style>

          @filamentStyles
          @vite('resources/css/app.css')
          </head>

          <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

              <h1 class="text-lg font-semibold mb-6">Roles</h1>

              @livewire('list-roles')
          </div>

          @filamentScripts
          @vite('resources/js/app.js')

          </html>

      </x-app-layout>
  @else
      <h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1>
  @endif
