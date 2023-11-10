<form action = "/search" method="post"> 
@csrf

<table>
    <tr>
        <td>Brand:</td>
        <td>
        <select name="brand_id">
        <option value="0">seleziona</option>
        <option value="---">Non appartiene a nessuna marca</option>
            @foreach ($brands as $brand)
                @if ($brand_id == $brand->id)
                    <option selected="selected" value="{{ $brand->id }}">{{ $brand->nome }}</option>
                @else
                    <option value="{{ $brand->id }}">{{ $brand->nome }}</option>
                @endif
            @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>Categoria:</td>
        <td>
            <input type="checkbox" name="category_id[]" value="---" />Non appartiene a nessuna categoria<br>
            @foreach ($categories as $category)
            <?php if (in_array($category->id, $arrCategory_id)) { ?>
                <input type="checkbox" checked="checked" name="category_id[]" value="{{ $category->id }}" />{{ $category->nome }}<br>
            <?php } else { ?>
                <input type="checkbox" name="category_id[]" value="{{ $category->id }}" />{{ $category->nome }}<br>
            <?php } ?>                
            @endforeach
        </td>
    </tr>
    <tr>
        <td>Titolo:</td>
        <td><input type="text" name="titolo" value="{{ old('titolo') }}" /></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="submit" value="Cerca"/></td>
    </tr>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <tr><td colspan="2">{{ $error }}</td></tr>
        @endforeach
    @endif
</table>
</from>