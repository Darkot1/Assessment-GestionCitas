<div class="max-w-7xl mx-auto px-4 sm:px-6 py-4" >
    <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Mis Citas
        </h2>
        @livewire('appointment.create-appointments')
        @if($appointments->isEmpty())
            <p>No tienes citas agendadas.</p>
        @else
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Doctor</th>
                        <th class="py-2 px-4 border-b">Fecha y Hora</th>
                        <th class="py-2 px-4 border-b">Motivo</th>
                        <th class="py-2 px-4 border-b">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $appointment->doctor->name }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($appointment->start_time)->format('d/m/Y H:i') }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->reason }}</td>
                            <td class="py-2 px-4 border-b">
                                <span class="px-2 py-1 rounded 
                                    {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                    ($appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td class="py-2 px-4 border-b">
                                @if($appointment->status === 'pending')
                                    <button wire:click="changeStatus({{ $appointment->id }}, 'confirmed')" class="text-blue-500 hover:underline">Confirmar</button>
                                    <button wire:click="changeStatus({{ $appointment->id }}, 'cancelled')" class="text-red-500 hover:underline">Cancelar</button>
                                @elseif($appointment->status === 'confirmed')
                                    <button wire:click="changeStatus({{ $appointment->id }}, 'cancelled')" class="text-red-500 hover:underline">Cancelar</button>
                                    <button wire:click="changeStatus({{ $appointment->id }}, 'finished')" class="text-green-500 hover:underline">Realizada</button>
                                @else
                                    <span class="text-gray-500">Estado finalizado</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
</div>
