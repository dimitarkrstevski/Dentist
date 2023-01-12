<x-app-layout xmlns="http://www.w3.org/1999/html">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Appointment Details') }}
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
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            @foreach($appointment as $a)
                            <p>Date: {{\Carbon\Carbon::parse($a->date)->format('d-m-Y')}}</p>
                                <p>Time: {{\Carbon\Carbon::parse($a->time)->format('h:i')}}</p>
                                <p>Description: {{$a->description}}</p>
                            @endforeach
                            <hr>
                                <h3>Patient Details: </h3>
                                <br>

                            @foreach($patient as $p)
                                <p>Name: {{$p->name}}</p>
                                <p>Surname: {{$p->surname}}</p>
                                <p>EMBG: {{$p->EMBG}}</p>
                                <p>E-mail: {{$p->email}}</p>
                                <p>Phone: {{$p->phone_number}}</p>
                                @endforeach

                            <hr>

                            @foreach($appointment as $a)
                                @if($a->doctor_id == null)
                                    <h5>Select this patient:</h5>
                                    <br>
                                    <form method="POST" action="{{route('selectPatient', $a->id)}}">
                                        @csrf

                                        <div class="flex items-center justify-end mt-4">

                                            <x-button class="ml-4">
                                                {{ __('Select') }}
                                            </x-button>
                                        </div>
                                    </form>
                                    @elseif($hasExamination == 0)
                                        <h5>Add examination details:</h5>
                                        <br>
                                        <form method="POST" action="{{route('examinations.store')}}">
                                            @csrf
                                            <input type="text" value="{{$a->id}}" hidden name="appointment_id">
                                                    <x-label for="description" :value="__('Description')" />

                                                    <textarea id="description" class="block mt-1 w-full" type="text" name="description"
                                                              :value="old('description')"   /> </textarea>
                                                    <div class="row mb-4">
                                                        @error('description')
                                                        <span class="text-red-700"> {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                <x-button class="ml-4">
                                                    {{ __('Add examination details') }}
                                                </x-button>
                                            </div>
                                        </form>
                                    @elseif($hasExamination > 0)
                                       <div>
                                           <h4>Examination Details: </h4>
                                           <p>{{$examinationDetails}}</p>
                                       </div>
                                    @endif
                                @endforeach

                        </div>
                    </div>
                </div>
        </div>

</x-app-layout>
