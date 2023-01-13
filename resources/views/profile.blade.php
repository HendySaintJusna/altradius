@extends('layouts.inapp')

@section('content')
<div class="container" id="app">

    <profileTarget v-bind:target="{{$target}}" connected="{{$connected}}" v-bind:members="{{$members}}"></profileTarget>

</div>
@endsection
