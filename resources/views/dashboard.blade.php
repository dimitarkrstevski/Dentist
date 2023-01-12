<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 2)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                        <h1>Schedule</h1>
                        <hr>
                        <div class="overflow-x-auto relative">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Date
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Patient
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        See details
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $appointment)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{\Carbon\Carbon::parse($appointment->date)->format('d-m-Y')}}
                                            {{\Carbon\Carbon::parse($appointment->time)->format('h:i')}}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{$appointment->name}} {{$appointment->surname}}
                                        </td>
                                        <td class="py-4 px-6">
                                            <button>
                                                <a href="{{route('showAppointment', $appointment->id)}}">See details</a>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 4)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="overflow-x-auto relative">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Price name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Description
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Price
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $price)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$price->name}}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{$price->description}}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{$price->price}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1>Earnings in the current month: {{$price}}</h1>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
