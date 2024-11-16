<div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">
    {{ $search }}
    <input type="text" wire:model="search" placeholder="Buscar...">
    @livewire('Doctor.create-doctors')
    <div wire:key="doctor-list">
        <h2 class="text-xl font-bold mb-4">Lista de Doctores</h2>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Nombre</th>
                    <th class="py-2 px-4 border-b text-left">Email</th>
                    <th class="py-2 px-4 border-b text-left">Teléfono</th>
                    <th class="py-2 px-4 border-b text-left">Especialidad</th>
                    <th class="py-2 px-4 border-b text-left">Estado</th>
                    <th class="py-2 px-4 border-b text-left">Disponibilidad</th> 
                    <th class="py-2 px-4 border-b text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($doctors as $doctor)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $doctor->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $doctor->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $doctor->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $doctor->phone_number ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">{{ $doctor->speciality }}</td>
                        <td class="py-2 px-4 border-b">
                            <span
                                class="px-2 py-1 rounded 
                                {{ $doctor->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($doctor->status) }}
                            </span>
                        </td>
                        
                        <td class="py-2 px-4 border-b">
                            @foreach ($doctor->availabilities as $availability)
                                <div>{{ \Carbon\Carbon::parse($availability->start_time)->format('d/m/Y H:i') }} - {{ \Carbon\Carbon::parse($availability->end_time)->format('d/m/Y H:i') }}</div>
                            @endforeach
                        </td>
                        <td class="py-2 px-4 border-b">
                            <button class="text-blue-500 hover:underline"
                                wire:click="editDoctor({{ $doctor->id }})">Editar</button>
                            <button class="text-red-500 hover:underline"
                                wire:click="deleteDoctor({{ $doctor->id }})">Eliminar</button>
                            <button class="text-green-500 hover:underline"
                                wire:click="scheduleDoctor({{ $doctor->id }})">Agendar Horario</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-2 px-4 text-center text-gray-500">No hay doctores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($showScheduleModal)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>
            <div class="bg-white p-6 rounded-md shadow-md w-96 relative z-10">
                <h2 class="text-xl font-bold mb-4">Agendar Horario para: {{ $selectedDoctor->name }}</h2>

                <form wire:submit.prevent="scheduleDoctorAvailability">
                    <div class="mb-4">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Hora de Inicio</label>
                        <input type="datetime-local" id="start_time" wire:model="start_time"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('start_time')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">Hora de Fin</label>
                        <input type="datetime-local" id="end_time" wire:model="end_time"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('end_time')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agendar</button>
                    <button type="button" wire:click="$set('showScheduleModal', false)"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cerrar</button>
                </form>
            </div>
        </div>
    @endif
</div>
