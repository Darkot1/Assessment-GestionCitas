<div class="max-w-2xl mx-auto bg-white p-6 rounded-md shadow-md">
    <button
        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mb-4"
        wire:click="$set('isModalOpen', true)">
        Agendar Cita
    </button>

    @if ($isModalOpen)
        <div class="fixed inset-0 flex items-center justify-center z-50" wire:poll.2s>
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>
            <div class="bg-white p-6 rounded-md shadow-md w-96 relative z-10">
                <h2 class="text-xl font-bold mb-4">Agendar Cita</h2>

                @if (session()->has('message'))
                    <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="createAppointment">
                    <div class="mb-4">
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700">Selecciona un Doctor</label>
                        <select wire:model="doctor_id" id="doctor_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Selecciona un doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }} - {{ $doctor->speciality }}</option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($doctor_id)
                        <div class="mb-4">
                            <h3 class="text-lg font-bold">Horarios Disponibles</h3>
                            @if ($availabilities && $availabilities->isNotEmpty())
                                <ul>
                                    @foreach ($availabilities as $availability)
                                        <li>
                                            {{ \Carbon\Carbon::parse($availability->start_time)->format('d/m/Y h:i A') }} -
                                            {{ \Carbon\Carbon::parse($availability->end_time)->format('d/m/Y h:i A') }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500">No hay horarios disponibles para este doctor.</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Hora de la Cita</label>
                            <input wire:model="start_time" type="datetime-local" id="start_time"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @error('start_time')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700">Hora de Finalización</label>
                            <input wire:model="end_time" type="datetime-local" id="end_time" readonly
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @error('end_time')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-gray-700">Motivo de la Cita</label>
                        <input wire:model="reason" type="text" id="reason"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Escribe el motivo de la cita">
                        @error('reason')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6 flex justify-between">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agendar
                            Cita</button>
                        <button type="button" wire:click="$set('isModalOpen', false)"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
