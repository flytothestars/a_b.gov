<p>Уважаемый/ая {{$distributorData['fio']}},</p>
<p>Вам назначены для распределения новые обращения на портале Almatybusiness.</p>

@if(!empty($distributorData['head_new_appeal']))
<p>Количество новых обращений:   {{$distributorData['count_head_new_appeal']}}</p>
<p>Дата:  {{$distributorData['date']}}</p>
<p>Список новых обращений:</p>
<table>
    <thead>    
            <tr>
                <th>#</th>
                <th>БИН/ИИН заявителя</th>
                <th>Компания</th>
                <th>Категория вопроса</th>
                <th>Имя Фамилия Консультанта</th>
            </tr>
    </thead>

    <tbody>
       
            @foreach($distributorData['head_new_appeal'] as $appeal)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td>{{ $appeal['iin'] }}</td>
                <td>{{ $appeal['organizations_name'] }}</td>
                <td>{{ $appeal['category_name'] }}</td>
                <td>{{ $appeal['fio'] }}</td>
            </tr>
            @endforeach
        
    </tbody>
</table>
<br>
<br>
@endif
@if(!empty($distributorData['head_appeal_approve']))
<p>Количество обращений, которые требуют подтверждения: {{$distributorData['count_head_appeal_approve']}}</p>
<p>Дата:{{$distributorData['date']}}</p>
<p>Список обращений, которые требуют подтверждения: </p>
<table>
    <thead>    
            <tr>
                <th>#</th>
                <th>БИН/ИИН заявителя</th>
                <th>Компания</th>
                <th>Категория вопроса</th>
                <th>Имя Фамилия Консультанта</th>
            </tr>
    </thead>

    <tbody>
       
            @foreach($distributorData['head_appeal_approve'] as $appeals_for_approve)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td>{{ $appeals_for_approve['iin'] }}</td>
                <td>{{ $appeals_for_approve['organizations_name'] }}</td>
                <td>{{ $appeals_for_approve['category_name'] }}</td>
                <td>{{ $appeals_for_approve['fio'] }}</td>
            </tr>
            @endforeach
        
    </tbody>
</table>
@endif