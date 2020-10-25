<table class=" w-full text-sm table-fixed ">
    <thead>
    <tr class="bg-gray-100">
        <th class="text-left px-3 py-3 sm:w-auto md:w-1/2">Alumno</th>
        <th class="text-left px-3 py-3">Legajo</th>
        <th class="text-left px-3 py-3">Fecha Inicio</th>
        <th class="text-left px-3 py-3">Cant. Avances</th>
        <th class="text-left px-3 py-3 sm:w-auto md:w-1/5">Tutor</th>
        <th class="text-left px-3 py-3">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($professionalPractices as $p)
        <tr>
            <td class="px-3 py-3">{{ $p->solicitude->student->name }}</td>
            <td class="px-3 py-3">{{ $p->solicitude->student->file_number }}</td>
            <td class="px-3 py-3">{{ $p->created_at->format('d/m/Y') }}</td>
            <td class="px-3 py-3">{{ $p->revisions->count()}}</td>
            <td class="px-3 py-3">{{ $p->tutor->name }}</td>
            <td class="px-3 py-3">
                <a href="{{ route('professional-practices.show', ['professionalPractice' => $p]) }}" class="button">Ver</a>
            </td>
        </tr>
    @endforeach

    @if($professionalPractices->count() == 0)
        <tr>
            <td class="px-3 py-3" colspan="4">No hay prácticas profesionales para mostrar</td>
        </tr>
    @endif
    </tbody>
</table>