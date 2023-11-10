<table border="1">
    <tr>
        <td>ID</td>
        <td>Nome</td>
        <td>Quantit&agrave;</td>
        <td>Prezzo</td>
        <td>Immagine</td>
        <td>Descrizione</td>
        <td>Brand_id</td>
        <td>Nome categoria</td>
        <td>creato</td>
        <td>modificato</td>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->id }} </td>
        <td>{{ $product->nomeprodotto }} </td>
        <td>{{ $product->quantita }} </td>
        <td>{{ $product->prezzo }} </td>
        <td>{{ $product->immagine }} </td>
        <td>{{ $product->descrizione }} </td>
        <td>{{ $product->brand_id }} : {{ $product->nomebrand }} </td>
        <td>{{ $product->nomecategoria }} </td>
        <td>{{ $product->created_at }} </td>
        <td>{{ $product->updated_at }} </td>
    </tr>
    @endforeach

    <tr><td colspan="9">Numero di prodotti: {{ $count }}</td></tr>
    <tr><td colspan="9">Prezzo massimo: {{ $maxPrezzo }}</td></tr>

</table>