<select name="ciudad" id="ciudades" class="form-control">
    <option value="" disabled selected>Ciudad</option>
    @foreach ($ciudades as $ciudad)
        <option value="{{ $ciudad->id }}">{{ $ciudad->name }}</option>
    @endforeach
</select>