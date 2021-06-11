<table class=" w-full text-sm table-fixed ">
    <thead>
    <tr class="bg-gray-100">
        <th class="text-left px-3 py-3">Legajo</th>
        <th class="text-left px-3 py-3 sm:w-auto md:w-1/4">Cargo</th>
        <th class="text-left px-3 py-3 sm:w-auto md:w-1/4">Nombre</th>
        <th class="text-left px-3 py-3 sm:w-auto md:w-1/4">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        @if ($user->role->name != 'admin')
            <tr>
                <td class="px-3 py-3">{{ $user->file_number }}</td>
                <td class="px-3 py-3">{{ strtoupper($user->role->name)}}</td>
                <td class="px-3 py-3">{{ $user->name }}</td>
                <td class="px-3 py-3">
                    <a href="{{ route('users.show', ['user' => $user]) }}" class="button">Editar</a>
                        <form class="inline-block" id="logout-form" action="{{ route('users.delete', ['user' => $user]) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button class="button delete-button leading-tight" type="submit">Borrar</button>
                        </form>
                </td>
            </tr>
        @endif
    @endforeach

    @if($users->count() == 0)
        <tr>
            <td class="px-3 py-3" colspan="4">No hay usuarios para mostrar</td>
        </tr>
    @endif
    </tbody>
</table>
<div class="custom-pagination pb-3">
    {!! $users->links() !!}
</div>