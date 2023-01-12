<x-app-layout xmlns="http://www.w3.org/1999/html">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div id="alert-border-3"
                         class="flex p-4 mb-4 bg-green-100 border-t-4 border-green-500 dark:bg-green-200" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3 text-sm font-medium text-green-700">
                            {{ session('success') }}
                        </div>
                        <button type="button"
                                class="ml-auto -mx-1.5 -my-1.5 bg-green-100 dark:bg-green-200 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 dark:hover:bg-green-300 inline-flex h-8 w-8"
                                data-dismiss-target="#alert-border-3" aria-label="Close" onclick="closeAlert(event)">
                            <span class="sr-only">Dismiss</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    @endif
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form method="POST" action="{{route('updateProfile', $user->id)}}">
                            @csrf
                            @method('PUT')
                            <!-- Name -->
                            <div>
                                <x-label for="name" :value="__('Name')"/>

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                         value="{{$user->name}}"/>
                                <div class="row mb-4">
                                    @error('name')
                                    <span class=" text-red-700"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Name -->
                            <div>
                                <x-label for="surname" :value="__('Surname')"/>

                                <x-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                                         value="{{$user->surname}}"/>
                                <div class="row mb-4">
                                    @error('surname')
                                    <span class=" text-red-700"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')"/>

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                         value="{{$user->email}}"/>
                                <div class="row mb-4">
                                    @error('email')
                                    <span class=" text-red-700"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Name -->
                            <div>
                                <x-label for="EMBG" :value="__('EMBG')"/>

                                <x-input id="EMBG" class="block mt-1 w-full" type="number" name="EMBG"
                                         value="{{$user->EMBG}}"/>
                                <div class="row mb-4">
                                    @error('EMBG')
                                    <span class=" text-red-700"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Name -->
                            <div>
                                <x-label for="phone" :value="__('Phone')"/>
                                <x-input id="phone" class="block mt-1 w-full" type="number" name="phone_number"
                                         value="{{$user->phone_number}}"/>
                                <div class="row mb-4">
                                    @error('phone_number')
                                    <span class=" text-red-700"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Name -->
                            <div>
                                <x-label for="street" :value="__('Street')"/>

                                <x-input id="street" class="block mt-1 w-full" type="text" name="street"
                                         value="{{$user->street}}"/>
                                <div class="row mb-4">
                                    @error('street')
                                    <span class=" text-red-700"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Name -->
                            <div>
                                <x-label for="city" :value="__('City')"/>

                                <x-input id="city" class="block mt-1 w-full" type="text" name="city"
                                         value="{{$user->city}}"/>
                                <div class="row mb-4">
                                    @error('city')
                                    <span class=" text-red-700"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Name -->
                            <div>
                                <x-label for="birth" :value="__('Date of birth')"/>

                                <x-input id="birth" class="block mt-1 w-full" type="date" name="date_of_birth"
                                         value="{{$user->date_of_birth}}"/>
                                <div class="row mb-4">
                                    @error('date_of_birth')
                                    <span class=" text-red-700"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">


                                <x-button class="ml-4">
                                    {{ __('Edit') }}
                                </x-button>
                            </div>
                        </form>
                        <br>
                        <br>
                        <hr>

                        <!-- additional -->
                      @if($user->role_id === 2)
                           <form method="POST" action="{{route('editBio', $user->id)}}">
                               @csrf
                               @method('PUT')
                               <div>
                                   <x-label for="bio" :value="__('Biography')"/>
                                   <textarea id="bio" class="block mt-1 w-full"  name="short_bio"/>
                                   {{$bio}}
                               </textarea>
                                   <x-button class="ml-4 mt-3">
                                       {{ __('Edit Bio') }}
                                   </x-button>
                               </div>
                    </div>
                           </form>
                    @endif

                    @if($user->role_id === 4)
                        <form method="POST" action="{{route('healthIdEdit', $user->id)}}">
                            @csrf
                            @method('PUT')
                            <div>
                                <x-label for="health_id" :value="__('Health ID')"/>

                                <x-input id="health_id" class="block mt-1 w-full" type="text" name="health_id"
                                         value="{{$healthId}}"/>
                                <x-button class="ml-4 mt-3">
                                    {{ __('Edit Health ID') }}
                                </x-button>
                            </div>
                </div>
                </form>
            @endif
                </div>
        </div>
    </div>

    <script>
        function closeAlert(event) {
            let element = event.target;
            while (element.nodeName !== "BUTTON") {
                element = element.parentNode;
            }
            element.parentNode.parentNode.removeChild(element.parentNode);
        }
    </script>

</x-app-layout>
