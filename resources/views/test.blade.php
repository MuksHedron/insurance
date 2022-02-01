<div class="col-12">
    <label for="lobid" class="required">Sub LOB</label>
    <select name="lobid" class="form-control" required>
        <option value=""> -- Select One --</option>
        @foreach($lobs as $lob)
        <div class="col-12">
            <option value="{{ $lob->id }}" @isset($file) {{  $lob->id ==  $file->lobid ? 'selected' : '' }} @endisset> {{ $lob->name }}</option>
        </div>
        @endforeach
    </select>
</div>