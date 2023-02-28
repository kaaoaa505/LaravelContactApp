@foreach ($companies as $id => $name)
    <option value="{{ $id }}" {{ ($company_id == $id || old('company_id') == $id) ? 'selected' : '' }}>
        {{ $name }}
    </option>
@endforeach
