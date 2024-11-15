<div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">
    {{$search}}
    <input type="text" wire:model="search" placeholder="Buscar...">
    @livewire('Doctor.create-doctors')
    <div wire:key="doctor-list" >
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
                            <span class="px-2 py-1 rounded 
                                {{ $doctor->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($doctor->status) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <button class="text-blue-500 hover:underline" wire:click="editDoctor({{ $doctor->id }})">Editar</button>
                            <button class="text-red-500 hover:underline" wire:click="deleteDoctor({{ $doctor->id }})">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-2 px-4 text-center text-gray-500">No hay doctores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>    
</div>
