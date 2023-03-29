<meta charset="UTF-8">
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>uid</th>
        <th>Заявитель</th>
        <th>ИИН/БИН</th>
        <th>Содержание</th>
        <th>Категория</th>
        <th>Статус</th>
        <th>Статус заявки</th>
        <th>Дата создание</th>
        <th>Дата изменение заявки</th>
        <th>Комментарий при исполнении/отказе</th>
    </tr>
    </thead>
    <tbody>
    @foreach($loans as $loan)
        <tr>
            <td>{{ $loan->id}}</td>
            <td>{{ $loan->mio_id}}</td>
            <td>{{ $loan->name }}</td>
            <td>{{ $loan->iin }}</td>
            <td>{{ $loan->content }}</td>
            <td>{{ $loan->category }}</td>
            <td>{{ $loan->client_appeal_status }}</td>
            <td>{{ $loan->appeal_status }}</td>
            <td>{{ \Carbon\Carbon::parse($loan->createDate)->format('d.m.Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($loan->updated_at)->format('d.m.Y') }}</td>
            <td>{{ $loan->comment ?? '' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
