<select name="departamento" id="deptos" class="form-control">
    <option value="" disabled selected>Seleccione un Departamento</option>
    @foreach ($departamentos as $departamento)
        <option value="{{ $departamento->id }}">{{ $departamento->name }}</option>
    @endforeach
</select>