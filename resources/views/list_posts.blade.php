@extends('main')
@section('title','List Posts')
@section('content')
<table border="1" style="border-collapse: collapse;" cellpadding="5">
    <thead>
    <tr>
        <th>NO</th>
        <th>JUDUL ARTIKEL</th>
        <th>PENULIS ARTIKEL</th>
        <th>TANGGAL TAYANG</th>
        <th>STATUS</th>
    </tr>
    </thead>    
    @foreach ($data['data'] as $key=>$item)
    <tbody>
        <tr>
            <td>{{ ($key+1) }}</td>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['authors'] }}</td>
            <td>{{ $item['publish_date'] }}</td>
            <td>{{ $item['publish_active'] == 1 ? 'Aktif' : 'Tidak Aktif'}}</td>
        </tr>
    </tbody>    
    @endforeach
</table>
@endsection
