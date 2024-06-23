@extends('layouts.admin')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
</head>
<body>
    <h1>QR Code Generator</h1>
    <div>{!! $qrCode !!}</div>1
</body>
</html>
@endsection
@section('scripts')
@parent

@endsection