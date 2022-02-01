@extends('layouts.app')

@section('title')
Reports
@endsection

@section('content')

<style>
    .fontsize32 {
        font-size: 32px !important;
    }

    .fontsize20 {
        font-size: 20px !important;
    }
</style>


<div class="iq-card-body">
    <span class="fontsize32">Customer profile verification form</span>
</div>

<div class="iq-card-body">
    <span class="text-decoration-underline fontsize32">Investigator particulars</span>

</div>


<table class="table table-bordered border-primary">
    <tbody>

        <tr>
            <td>Agency name</td>
            <td>Contact number</td>
            <td>Assignment date</td>
            <td>Report submission date</td>
        </tr>

        <tr>
            <td>{{$report->ismeet ?? ''}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>Decision</td>
            <td></td>
            <td>Evidence available</td>
            <td>Yes / No</td>
        </tr>

        <tr>
            <td>Evidence details</td>
            <td colspan="3"></td>
        </tr>

        <tr>
            <td>Remarks</td>
            <td colspan="3"></td>
        </tr>

    </tbody>
</table>



<div class="iq-card-body">
    <span class="text-decoration-underline fontsize32">Case details</span>
</div>



<table class="table table-bordered border-primary">
    <tbody>

        <tr>
            <td>Application no.</td>
            <td>Policy no</td>
            <td>Issue date</td>
            <td>Product</td>
            <td>Sum assured</td>
            <td>Premium amount</td>
        </tr>

        <tr>
            <td></td>
            <td>{{$file->policyno ?? ''}}</td>
            <td></td>
            <td>{{$file->clients->name ?? ''}}</td>
            <td></td>
            <td></td>
        </tr>

    </tbody>
</table>


<div class="iq-card-body">
    <span class="text-decoration-underline fontsize32">Proposal verification</span>
</div>


<table class="table table-bordered border-primary">
    <tbody>

        <tr>
            <td>Locality of LA</td>
            <td>{{$report->locality ?? ''}}</td>
        </tr>

        <tr>
            <td>Existence of LA established</td>
            <td></td>
        </tr>

        <tr>
            <td>Was LA met</td>
            <td>{{$report->ismeet ?? ''}}</td>
        </tr>
        <tr>
            <td>If LA not met, whom did you meet</td>
            <td></td>
        </tr>
        <tr>
            <td>If family then relationship with LA</td>
            <td>{{$report->whommeet ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-center fontsize20">Life Assured details</td>
        </tr>
        <tr>
            <td>Date of birth of LA</td>
            <td>{{$report->dob ?? ''}}</td>
        </tr>
        <tr>
            <td>Identity proof of LA</td>
            <td>{{$report->idproof ?? ''}} / {{$report->idproofno ?? ''}}</td>
        </tr>
        <tr>
            <td>Address proof of LA</td>
            <td>{{$report->addressproof ?? ''}} {{$report->addressproofno ?? ''}}</td>
        </tr>
        <tr>
            <td>Education of LA</td>
            <td>{{$report->laeduqualification ?? ''}}</td>
        </tr>
        <tr>
            <td>Health details of LA</td>
            <td>{{$report->anyillness ?? ''}} {{$report->detailsofillness ?? ''}}</td>
        </tr>
        <tr>
            <td>Habits of LA</td>
            <td></td>
        </tr>
        <tr>
            <td>Quantity/ no. of years</td>
            <td>{{$report->noofmembers ?? ''}}</td>
        </tr>
        <tr>
            <td>Physical appearance of LA</td>
            <td></td>
        </tr>
        <tr>
            <td>If Handicapped, then</td>
            <td></td>
        </tr>
        <tr>
            <td>Existing insurance of LA</td>
            <td></td>
        </tr>
        <tr>
            <td>Live Photo of LA</td>
            <td></td>
        </tr>
        <tr>
            <td>Photo of residence of LA (complete house of LA should be visible)</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center fontsize20">Proposer details (details of LA to be collected for self-proposed policies LA = PR)</td>
        </tr>
        <tr>
            <td>Occupation</td>
            <td>{{$report->empcategory ?? ''}} </td>
        </tr>
        <tr>
            <td>Name of Company</td>
            <td>{{$report->employernameaddress ?? ''}} {{$report->laselfemployednameaddress ?? ''}}</td>
        </tr>
        <tr>
            <td>Income</td>
            <td>{{$report->laannualincome ?? ''}}</td>
        </tr>
        <tr>
            <td>Income proof</td>
            <td>{{$report->laproofincome ?? ''}}</td>
        </tr>
        <tr>
            <td>Number of members in family</td>
            <td>{{$report->noofmembers ?? ''}}</td>
        </tr>
        <tr>
            <td>Number of earning members in family</td>
            <td></td>
        </tr>
        <tr>
            <td>Photo of office/shop</td>
            <td></td>
        </tr>
        <tr>
            <td>Type of house</td>
            <td></td>
        </tr>

    </tbody>
</table>



<div class="iq-card-body">
    <span class="text-decoration-underline fontsize32">Vicinity check</span>
</div>


<table class="table table-bordered border-primary">
    <tbody>

        <tr>
            <td colspan="2" class="text-center fontsize20">Personal details as per vicinity</td>
        </tr>

        <tr>
            <td>Education of LA</td>
            <td>{{$report->laeduqualification ?? ''}}</td>
        </tr>
        <tr>
            <td>Health details of LA</td>
            <td>{{$report->condition ?? ''}}</td>
        </tr>
        <tr>
            <td>Habits of LA</td>
            <td></td>
        </tr>
        <tr>
            <td>Quantity/ no. of years</td>
            <td></td>
        </tr>
        <tr>
            <td>Physical appearance of LA</td>
            <td></td>
        </tr>
        <tr>
            <td>Since how many years is LA’s family staying at this address</td>
            <td>{{$report->yearscurrentresidence ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-center fontsize20">Income details as per vicinity</td>
        </tr>
        <tr>
            <td>Occupation</td>
            <td>{{$report->empcategory ?? ''}}</td>
        </tr>
        <tr>
            <td>Name of Company</td>
            <td>{{$report->employernameaddress ?? ''}} {{$report->laselfemployednameaddress ?? ''}}</td>
        </tr>
        <tr>
            <td>Income</td>
            <td>{{$report->laannualincome ?? ''}}</td>
        </tr>
        <tr>
            <td>Family income</td>
            <td>{{$report->spouseincome ?? ''}}</td>
        </tr>
        <tr>
            <td>Number of members in family</td>
            <td>{{$report->noofmembers ?? ''}}</td>
        </tr>
        <tr>
            <td>Number of earning members in family</td>
            <td></td>
        </tr>

    </tbody>
</table>



<table class="table table-bordered border-primary">
    <tbody>

        <tr>
            <td>Sr no</td>
            <td>Name of person/company</td>
            <td>Relationship</td>
            <td>Contact no</td>
            <td>Address</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>


        <tr>
            <td colspan="5">Remarks/ Details:</td>

        </tr>

        <tr>
            <td colspan="5">Medical check conclusion:</td>

        </tr>

        <div class="iq-card-body">
            <span class="text-decoration-underline fontsize32">In case of DBRCD, Death Certificate / Cemetery Verification:</span>
        </div>

        <tr>
            <td>Name of authority</td>
            <td></td>
        </tr>

        <tr>
            <td>Designation and location</td>
            <td></td>
        </tr>

        <tr>
            <td>Contact number</td>
            <td></td>
        </tr>

        <tr>
            <td>Date of death in register</td>
            <td></td>
        </tr>

        <tr>
            <td>Death certificate issue date</td>
            <td></td>
        </tr>

        <tr>
            <td>Cause of death (if available)</td>
            <td></td>
        </tr>

        <tr>
            <td>Life Assured cremation/burial</td>
            <td></td>
            <td>Timing:</td>
        </tr>

        <tr>
            <td>Death certificate verified</td>
            <td></td>
        </tr>
    </tbody>
</table>

<div class="iq-card-body">
    <span class="text-decoration-underline fontsize32">Other insurance details</span></br>
    <span>(Please collect husband’s insurance details if Life Assured is a housewife, parent’s insurance details if Life Assured is a student)</span>
</div>

<table class="table table-bordered border-primary">
    <tbody>

        <tr>
            <td>Name of Life Assured/ Proposer</td>
            <td>Name of Company</td>
            <td>Contract/ Proposal number</td>
            <td>Sum assured</td>
            <td>RCD</td>
            <td>Policy status (Inforce/ Lapsed/Applied)</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

    </tbody>
</table>



<div class="iq-card-body">
    <span class="text-decoration-underline fontsize32">Family History</span>
</div>

<table class="table table-bordered border-primary">
    <tbody>

        <tr>
            <td>Sr. No</td>
            <td>Name of member</td>
            <td>Relationship with Life Assured</td>
            <td>Age</td>
            <td>Occupation</td>
            <td>Income</td>
            <td>KYC</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>


<div class="iq-card-body">
    <span class="text-decoration-underline fontsize32">Overall Remarks/Conclusion verified</span>
</div>

@endsection