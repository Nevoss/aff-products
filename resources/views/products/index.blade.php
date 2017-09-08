@extends('layouts.app')

@section('content')
  <div class="container mt-4">

    @if ($category->exists)
      <h2> {{ $category->name }} </h2>
      <p> {{ $category->description }} </p>
    @else
      <h2> All Products </h2>
      <p></p>
    @endif

    <products-list :data-category="{{ ($category->exists) ? $category : 'null' }}"></products-list>
  </div>
@endsection
