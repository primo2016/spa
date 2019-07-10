@extends('layouts.app')

@section('stylesheets')

<!-- Datatables Js-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css" />

@endsection

@section('content')

<!-- search box container starts  -->
<div class="container">
    <h3 class="text-center title-color">Drag and Drop Datatables Using jQuery UI Sortable - Demo </h3>
    <p>&nbsp;</p>
    @include('tasks.partials.form')
    <hr>
    @include('tasks.partials.list')
    <hr>
    <h5>Drag and Drop the table rows and <button class="btn btn-default" onclick="window.location.reload()"><b>REFRESH</b></button> the page to check the Demo. For the complete tutorial of how to make this demo app visit the following <a href="#">Link</a>.</h5>
</div>


@stop

@section('scripts')

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!-- jQuery UI -->
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Datatables Js-->
<script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

@yield('scriptsform')
@yield('scriptslist')

@stop
