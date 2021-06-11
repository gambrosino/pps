<div class="card mx-10">
    <div class="card-header">
        <h3 class="card-title">
            Datos
        </h3>
    </div>
    <div class="card-body">
        <div class="mt-4">
            Nombre:
            <span class="text-gray-700 uppercase font-semibold tracking-wide">{{ $user->name }}</span>
        </div>
        <div class="mt-2">
            Email registrado:
            <span class="text-gray-700 font-semibold tracking-wide">{{ $user->email }}</span>
        </div>
        <div class="mt-2">
            Legajo:
            <span class="text-gray-700 font-semibold tracking-wide">{{ $user->file_number }}</span>
        </div>
    </div>
</div>