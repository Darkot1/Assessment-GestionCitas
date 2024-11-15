<div class="max-w-2xl mx-auto bg-white p-6 rounded-md shadow-md">

    <!-- Botón para abrir el modal -->
    <button 
        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mb-4"
        wire:click="$set('isModalOpen', true)">
        Crear Nuevo Doctor
    </button>

    <!-- Modal -->
    @if($isModalOpen)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>
            <div class="bg-white p-6 rounded-md shadow-md w-96 relative z-10">
                <h2 class="text-xl font-bold mb-4">Crear Nuevo Doctor</h2>

                <!-- Formulario de creación de doctor -->
                <form wire:submit.prevent="createDoctor">
                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Nombre completo del doctor">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" wire:model="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="doctor@correo.com">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" id="password" wire:model="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="******">
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-4">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" id="phone_number" wire:model="phone_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="123-456-7890">
                        @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" id="address" wire:model="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Dirección completa">
                        @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Especialidad -->
                    <div class="mb-4">
                        <label for="speciality" class="block text-sm font-medium text-gray-700">Especialidad</label>
                        <select id="speciality" wire:model="speciality" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" selected>Seleccione una especialidad</option>
                            <option value="dentist">Dentista</option>
                            <option value="surgeon">Cirujano</option>
                            <option value="physician">Médico General</option>
                            <option value="gynecologist">Ginecólogo</option>
                            <option value="pediatrician">Pediatra</option>
                            <option value="orthopedic">Ortopedista</option>
                        </select>
                        @error('speciality') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Botón de envío -->
                    <div class="mt-6 flex justify-between">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Crear Doctor</button>
                        <button type="button" wire:click="$set('isModalOpen', false)" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
