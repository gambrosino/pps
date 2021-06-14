<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Archivos de descarga:
        </h3>
    </div>
    <div class="card-body">
        <div class="mt-4">
            Solicitud:
            <a href="{{ $setting->solicitude_link }}" class="text-blue-600 uppercase font-semibold tracking-wide">Descargar archivo</a>
        </div>
        <div class="mt-2">
            Avance:
            <a href="{{ $setting->revision_link }}" class="text-blue-600 uppercase font-semibold tracking-wide">Descargar archivo</a>
        </div>
        <div class="mt-2">
            Reporte Final:
            <a href="{{ $setting->report_link }}" class="text-blue-600 uppercase font-semibold tracking-wide">Descargar archivo</a>
        </div>
    </div>
</div>