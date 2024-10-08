<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (Auth::user()->is_teacher)
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="bg-gray-900">
                <div class="mx-auto max-w-7xl">
                  <div class="py-10 bg-gray-900">
                    <div class="px-4 sm:px-6 lg:px-8">
                      <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                          <h1 class="text-base font-semibold leading-6 text-white">Prezențe astăzi</h1>
                          <p class="mt-2 text-sm text-gray-300">Lista cu prezențele zilei de astăzi</p>

                          <a href="/prezente-totale" class="mt-5 text-indigo-500">Vezi prezențe totale ></a>
                        </div>
                      </div>
                      <div class="flow-root mt-8">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-700">
                              <thead>
                                <tr>
                                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Nume</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Data si ora</th>
                                </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-800">
                                @foreach ($students as $student)
                                    <tr>
                                    <td class="py-4 pl-4 pr-3 text-sm font-medium text-white whitespace-nowrap sm:pl-0">{{ $student->name }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-300 whitespace-nowrap">{{ $student->accesses->count() ? $student->accesses->first()->accessed_at : '-' }}</td>
                                    </tr>

                                @endforeach

                                <!-- More people... -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

        </div>

        @else
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Bună ziua, {{ Auth::user()->name }}!
                    </div>
                </div>
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">


                    @if ($submittedAccess)
                    <div class="p-6 text-white">
                        Prezență înregistrată pentru astăzi!

                    </div>
                    @else
                        <div class="p-6 dark:text-gray-100">
                            Înregistrează prezența pentru astăzi apăsând următorul buton:

                            <form method="POST" action="{{ route('presence.store') }}">
                                @csrf

                                <div class="flex items-center justify-center mt-4">

                                    <x-primary-button class="ms-3">
                                        Înregistrează prezența
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

        @endif
    </div>
</x-app-layout>
