@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product name</th>
                <th scope="col">Product count</th>
                <th scope="col">Product category</th>
                <th scope="col">Created at</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($statistic as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->product_count }}</td>
                    <td>{{ $item->product_category }}</td>
                    <td>{{ $item->created_at }}</td>
                  </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection
