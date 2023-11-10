<table border="1">
    <tr>
        <td>ID</td>
        <td>Nome</td>
        <td>Quantit&agrave;</td>
        <td>Prezzo</td>
        <td>Immagine</td>
        <td>Descrizione</td>
        <td>Brand_id</td>
        <td>creato</td>
        <td>modificato</td>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->id }} </td>
        <td>{{ $product->nome }} </td>
        <td>{{ $product->quantita }} </td>
        <td>{{ $product->prezzo }} </td>
        <td>{{ $product->immagine }} </td>
        <td>{{ $product->descrizione }} </td>
        <td>{{ $product->brand_id }} </td>
        <td>{{ $product->created_at }} </td>
        <td>{{ $product->updated_at }} </td>
    </tr>
    @endforeach


</table>