<form action = "{{ $action }}" method="post"> 
@csrf

@if ($method == 'put')
    @method('PUT')
@endif

<table>
    <tr>
        <td>Nome brand:</td>
        <td><input type="text" name="brandName" value="{{ $brandName }}"/></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="submit" value="Salva"/></td>
    </tr>
</table>
</from>