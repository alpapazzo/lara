<table>
    <tr>
        <td>ID</td>
        <td>Nome</td>
    </tr>
    @foreach ($brands as $brand)
    <tr>
        <td>{{ $brand->id }} </td>
        <td>{{ $brand->nome }} </td>
    </tr>
    @endforeach


</table>