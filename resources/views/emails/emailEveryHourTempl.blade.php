<p>Уважаемый/ая {{$distributorData['fio']}},</p>
<p>Вам назначены для распределения новые обращение на портале Almatybusiness.</p>

@if(!empty($distributorData['new_appeals']))
<p>Количество новых обращений:   {{$distributorData['count_new_appeals']}}</p>
<p>Дата:  {{$distributorData['date']}}</p>
<p>Список новых обращений:</p>
<table>
    <thead>    
            <tr>
                <th>#</th>
                <th>БИН/ИИН заявителя</th>
                <th>Компания</th>
                <th>Категория вопроса</th>
            </tr>
    </thead>

    <tbody>
       
            @foreach($distributorData['new_appeals'] as $appeal)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td>{{ $appeal['iin'] }}</td>
                <td>{{ $appeal['organizations_name'] }}</td>
                <td>{{ $appeal['category_name'] }}</td>
            </tr>
            @endforeach
        
    </tbody>
</table>
<br>
<br>
@endif
@if(!empty($distributorData['appeals_for_approve']))
<p>Количество обращений, которые требуют подтверждения: {{$distributorData['count_appeals_for_approve']}}</p>
<p>Дата:{{$distributorData['date']}}</p>
<p>Список обращений, которые требуют подтверждения: </p>
<table>
    <thead>    
            <tr>
                <th>#</th>
                <th>БИН/ИИН заявителя</th>
                <th>Компания</th>
                <th>Категория вопроса</th>
            </tr>
    </thead>

    <tbody>
       
            @foreach($distributorData['appeals_for_approve'] as $appeals_for_approve)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td>{{ $appeals_for_approve['iin'] }}</td>
                <td>{{ $appeals_for_approve['organizations_name'] }}</td>
                <td>{{ $appeals_for_approve['category_name'] }}</td>
            </tr>
            @endforeach
        
    </tbody>
</table>
@endif