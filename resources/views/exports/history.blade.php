<meta charset="UTF-8">
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($loans as $loan)
        <tr>
            <td>{{ $loan->appeal_id}}</td>
            <td>{{ \Carbon\Carbon::parse($loan->created_at)->format('Y-m-d H:i:s') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
