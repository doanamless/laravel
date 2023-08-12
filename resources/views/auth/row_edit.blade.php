<tr id="{{$row->id}}">
    <td>{{$row->designation}}</td>
    <td>{{$row->marque}}</td>
    <td>{{$row->prix}}</td>
    <td>{{$row->date_aqui}}</td>
    <td>{{$row->prem_km}}</td>
    <td>{{$row->puissance}}</td>
    <td>{{$row->consommation}}</td>
    <td>{{$row->carburant}}</td>
    <td>{{$row->reference}}</td>
    <td>
        <button class="btn btn-info edit" data-route="{{url('/edit-vehicule/'.$row->id)}}" data-toggle="modal" data-target="#exampleModal2">Edit <i class="fa fa-edit"></i> </button>
        <button class="btn btn-danger delete" data-route="{{url('/delete-vehicule/'.$row->id)}}" >Delete <i class="fa fa-times"></i> </button>
    </td>
</tr>
