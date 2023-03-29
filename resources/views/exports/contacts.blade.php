<meta charset="UTF-8">
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>uid</th>
        <th>userId</th>
        <th>Заявитель</th>
        <th>ИИН/БИН</th>
        <th>Контакт</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->id}}</td>
            <td>{{ $contact->mio_id}}</td>
            <td>{{ $contact->userId}}</td>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->iin }}</td>
            <td>{{ $contact->phone_number }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

