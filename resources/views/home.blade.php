@extends('layouts.inapp')

@section('content')
<div class="container" id="app">

    <home v-bind:noti="{{$noti}}" v-bind:target="{{$user}}" v-bind:members="{{$members}}"></home>

</div>
@endsection
