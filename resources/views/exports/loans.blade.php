<meta charset="UTF-8">
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>Заявитель</th>
        <th>ИИН/БИН</th>
        <th>Контакты</th>
        <th>Содержание</th>
        <th>Категория</th>
        <th>Источник</th>
        <th>Статус</th>
        <th>Дата создание</th>
        <th>Консультант</th>
        <th>Статус заявки</th>
        <th>Дата изменение заявки</th>
        <th>Примечание</th>
    </tr>
    </thead>
    <tbody>
    @foreach($loans as $loan)
        <tr>
            <td>{{ $loan->id}}</td>
            <td>{{ $loan->full_name ? $loan->full_name : 'Нет данных'}}</td>
            <td>{{ $loan->name }}</td>
            <td>{{ $loan->iin }}</td>
            <td>{{ $loan->phone_number }}</td>
            <td>{{ $loan->content }}</td>
            <td>{{ $loan->category }}</td>
            <td>{{ $loan->source_type }}</td>
            <td>{{ $loan->client_appeal_status }}</td>
            <td>{{ \Carbon\Carbon::parse($loan->createDate)->format('d.m.Y H:i:s') }}</td>
            <td>{{ $loan->last_name . ' ' . $loan->first_name}}</td>
            <td>{{ $loan->appeal_status }}</td>
            <td>{{ \Carbon\Carbon::parse($loan->updated_at)->format('d.m.Y') }}</td>
            <td>{{ $loan->comment ? $loan->comment : 'Нет примечание' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
