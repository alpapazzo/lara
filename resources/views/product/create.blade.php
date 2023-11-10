<form action = "{{ $action }}" method="post"> 
@csrf

@if ($method == 'put')
    @method('PUT')
@endif

<table>
    <tr>
        <td>Nome prodotto:</td>
        <td><input type="text" name="nome_prodotto" value="{{ $product->nome }}"/></td>
    </tr>
    <tr>
        <td>Quatnita:</td>
        <td><input type="text" name="quantita_prodotto" value="{{ $product->quantita }}"/></td>
    </tr>
    <tr>
        <td>Prezzo</td>
        <td><input type="text" name="prezzo_prodotto" value="{{ $product->prezzo }}"/></td>
    </tr>
    <tr>
        <td>immagine:</td>
        <td><input type="text" name="immagine_prodotto" value="{{ $product->immagine }}"/></td>
    </tr>
    <tr>
        <td>Descrizione:</td>
        <td><input type="text" name="descrizione_prodotto" value="{{ $product->descrizione }}"/></td>
    </tr>
    <tr>
        <td>Brand:</td>
        
        <td>
            <select name="brand_id">
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
        <td colspan="2"><input type="submit" name="submit" value="Salva"/></td>
    </tr>
</table>
</from>