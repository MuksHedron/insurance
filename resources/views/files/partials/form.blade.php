@csrf
<div class="col-12">
    <label for="clientid" class="required">Client</label>

    <select name="clientid" class="form-control">
        <option value=""> -- Select One --</option>

        @foreach($clients as $client)
        <div class="mb-3">
            <option value="{{ $client->id }}" @isset($file) {{  $client->id  == $file->clientid ? 'selected' : '' }} @endisset>{{ $client->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<div class="col-12">
    <label for="hubid" class="required">Hub</label>

    <select name="hubid" class="form-control">
        <option value=""> -- Select One --</option>

        @foreach($hubs as $hub)
        <div class="mb-3">
            <option value="{{ $hub->id }}" @isset($file) {{  $hub->id  == $file->hubid ? 'selected' : '' }} @endisset>{{ $hub->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<div class="col-12">
    <label for="lobid" class="required">LOB</label>
    <select name="lobid" id="lobid" class="form-control" required>
        <option value=""> -- Select One --</option>
        @foreach($lobs as $lob)
        <div class="col-12">
            <option value="{{ $lob->id }}" @isset($file) {{  $lob->id ==  $file->lobid ? 'selected' : '' }} @endisset> {{ $lob->name }}</option>
        </div>
        @endforeach
    </select>
</div>

<div class="col-12">
    <label for="typeid" class="required">Sub LOB</label>
    <select name="typeid" id="typeid" class="form-control" required>
        <option value=""> -- Select One --</option>
    </select>
</div>

<div class="col-12">
    <label for="stateid" class="required">State</label>

    <select name="stateid" id="stateid" class="form-control" required>
        <option value=""> -- Select One --</option>
        @foreach($states as $state)
        <div class="mb-3">
            <option value="{{ $state->states->id }}" @isset($file) {{  $state->id == $file->stateid ? 'selected' : '' }} @endisset> {{ $state->states->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<div class="col-12">
    <label for="cityid" class="required">City</label>

    <select name="cityid" id="cityid" class="form-control" required>

    </select>
</div>

<div class="col-12">
    <label for="locationid" class="required">Location</label>
    <select name="locationid" id="locationid" class="form-control" required>
    </select>
</div>

<div class="col-12">
    <label for="policyno" class="required">Policy No</label>
    <input name="policyno" type="text" class="form-control @error('policyno') is-invalid @enderror" id="policyno" aria-describedby="policyno" required value="{{isset($file->policyno) ? $file->policyno : old('policyno')}}">
    @error('policyno')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">

    <label for="receivedon">Received On</label>
    <input name="receivedon" type="date" class="form-control @error('receivedon') is-invalid @enderror date" id="receivedon" aria-describedby="receivedon" value="{{isset($file->receivedon) ? $file->receivedon : old('receivedon')}}">
    @error('receivedon')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>


<div class="col-12">
    <label for="agent" class="required">Agent</label>

    <select name="agent" class="form-control">
        <option value=""> -- Select One --</option>
        <div class="mb-3">
            <option value="Y" @isset($file) {{  $file->agent ? 'selected' : '' }} @endisset>Yes</option>
            <option value="N" @isset($file) {{ $file->agent ? 'selected' : '' }} @endisset> No</option>
        </div>
    </select>
</div>


<div class="col-12">
    <label for="name" class="required">Name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value="{{isset($file->name) ? $file->name : old('name')}}">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">
    <label for="fathername" class="required">Father's Name</label>
    <input name="fathername" type="text" class="form-control @error('fathername') is-invalid @enderror" id="fathername" aria-describedby="fathername" required value="{{isset($file->fathername) ? $file->fathername : old('fathername')}}">
    @error('fathername')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">

    <label for="dob">DOB</label>
    <input name="dob" type="date" class="form-control @error('dob') is-invalid @enderror date" id="dob" aria-describedby="dob" value="{{isset($file->dob) ? $file->dob : old('dob')}}">
    @error('dob')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">
    <label for="nominee" class="required">Nominee Name</label>
    <input name="nominee" type="text" class="form-control @error('nominee') is-invalid @enderror" id="nominee" aria-describedby="nominee" required value="{{isset($file->nominee) ? $file->nominee : old('nominee')}}">
    @error('nominee')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>


<div class="col-12">
    <label for="relationid" class="required">Relationship</label>

    <select name="relationid" class="form-control" required>
        <option value=""> -- Select One --</option>
        @foreach($relations as $relation)
        <div class="mb-3">
            <option value="{{ $relation->id }}" @isset($file) {{  $relation->id == $file->relationid ? 'selected' : '' }} @endisset> {{ $relation->tag }}</option>
        </div>
        @endforeach

    </select>
</div>


<div class="col-12">
    <label for="address">Address</label>
    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="address" value="{{isset($file->address) ? $file->address : old('address')}}">
    @error('address')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">
    <label for="pincode">Pincode</label>
    <input name="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode" aria-describedby="pincode" value="{{isset($file->pincode) ? $file->pincode : old('pincode')}}">
    @error('pincode')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
<div class="col-12">
    <label for="mobile1">Mobile 1</label>
    <input name="mobile1" type="text" class="form-control @error('mobile1') is-invalid @enderror" id="mobile1" aria-describedby="mobile1" value="{{isset($file->mobile1) ? $file->mobile1 : old('mobile1')}}">
    @error('mobile1')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
<div class="col-12">
    <label for="mobile2">Mobile 2</label>
    <input name="mobile2" type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile2" aria-describedby="mobile2" value="{{isset($file->mobile2) ? $file->mobile2 : old('mobile2')}}">
    @error('mobile2')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
<div class="col-12">
    <label for="email">email ID</label>
    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{isset($file->email) ? $file->email : old('email')}}">
    @error('email')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>



<div class="form-group row mb-0" style="margin-top: 30px;">
    <div class="col-md-12 offset-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>








<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $(document).ready(function() {

        $('.date').datepicker({
            format: 'yyyy-mm-dd',
        });

        $('#dob').datepicker({
            maxDate: 0,
        });

        $('#incidentreported').datepicker({
            maxDate: 0,
        });

    });




    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#lobid').change(function() {

        var lobID = $(this).val();

        if (lobID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getsublobs') }}?lob_id=" + lobID,
                success: function(res) {

                    if (res) {

                        $("#typeid").empty();
                        $("#typeid").append('<option>Select Sub Lob</option>');
                        $.each(res, function(key, value) {
                            $("#typeid").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#typeid").empty();
                    }
                }
            });
        } else {

            $("#typeid").empty();
        }
    });



    $('#stateid').change(function() {

        var stateID = $(this).val();

        if (stateID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getcities') }}?state_id=" + stateID,
                success: function(res) {

                    if (res) {

                        $("#cityid").empty();
                        $("#cityid").append('<option>Select City</option>');
                        $.each(res, function(key, value) {
                            $("#cityid").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#cityid").empty();
                    }
                }
            });
        } else {

            $("#cityid").empty();
            $("#locationid").empty();
        }
    });


    $('#cityid').on('change', function() {

        var cityID = $(this).val();

        if (cityID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getlocations') }}?city_id=" + cityID,
                success: function(res) {
                    if (res) {

                        $("#locationid").empty();
                        $("#locationid").append('<option>Select Location</option>');
                        $.each(res, function(key, value) {

                            $("#locationid").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#locationid").empty();
                    }
                }
            });
        } else {

            $("#locationid").empty();
        }
    });
</script>