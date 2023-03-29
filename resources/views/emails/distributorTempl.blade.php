<p>Уважаемый/ая {{$distributorData['fio']}},</p>
<p>Вам назначены для распределения новые обращения и бизнесы на портале Almatybusiness.</p>

@if(!empty($distributorData['appeals']))
<p>Количество новых обращений:   {{$distributorData['count_appeals']}}</p>
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
       
            @foreach($distributorData['appeals'] as $appeal)
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
@if(!empty($distributorData['businesses']))
<p>Количество новых бизнесов: {{$distributorData['count_businesses']}}</p>
<p>Дата:{{$distributorData['date']}}</p>
<p>Список новых бизнесов: </p>
<table>
    <thead>    
            <tr>
                <th>#</th>
                <th>БИН бизнеса</th>
                <th>Компания</th>
                <th>Вид деятельности</th>
            </tr>
    </thead>

    <tbody>
       
            @foreach($distributorData['businesses'] as $business)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td>{{ $business['iin'] }}</td>
                <td>{{ $business['organizations_name'] }}</td>
                <td></td>
            </tr>
            @endforeach
        
    </tbody>
</table>
@endif