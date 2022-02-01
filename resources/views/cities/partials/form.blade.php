@csrf
<div class="form-group">
    <label for="name" class="required">City</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
     aria-describedby="name" required value="@isset($city) {{ old('name') === null ? $city->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">
    <label for="stateid" class="required">State</label>

    <select name="stateid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($states as $state)
        <div class="mb-3">
            <option value="{{ $state->id }}" @isset($city) {{  $state->id == $city->stateid ? 'selected' : '' }} @endisset> {{ $state->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>