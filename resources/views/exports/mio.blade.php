<meta charset="UTF-8">
<table>
    <thead>
    <tr>
        <th>Mio ID</th>
        <th>Статус</th>
        <th>Статус ID</th>
        <th>Статус Заявки</th>
        <th>Статус Заявки ID</th>
    </tr>
    </thead>
    <tbody>
    @foreach($loans as $loan)
        <tr>
            <td>{{ $loan->mio_id}}</td>
            <td>{{ $loan->appeal_name}}</td>
            <td>{{ $loan->appeal_status_id }}</td>
            <td>{{ $loan->client_name}}</td>
            <td>{{ $loan->client_appeal_status_id }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
