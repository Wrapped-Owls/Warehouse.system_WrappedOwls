<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Report</title>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Product Report</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Qr code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Current Value</th>
                    <th scope="col">Previous Value</th>
                    <th scope="col">Difference between values</th>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->code_product}}</th>
                        <td>
                            <img src="data:image/png;base64,{!!  base64_encode(QrCode::format('png')->size(60)->generate(route("main") . "/product/{$product->code_product}/detail")); !!}"/>
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->material_description}}</td>
                        <td>{{$product->item()->sum('total_inside')}}</td>
                        <td> R$ {{$product->price}}</td>
                        @if(isset($product->previous_price))
                            <td>$ {{$product->previous_price}}</td>
                        @else
                            <td>$ 0,00</td>
                        @endif
                        <td>$ {{$product->price - $product->previous_price}}</td>

                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Stopped Products</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Situation</th>
            </tr>
            </thead>
            <tbody>

            @foreach($stationaryProducts as $product)
                <tr>
                    <th scope="row">{{$product[0]["code_product"]}}</th>
                    <td>{{$product[0]["name"]}}</td>
                    <td>{{$product[0]["material_description"]}}</td>
                    @if($product[1]->m >= 3 and $product[1]->y==0)
                        <td>{{$product[1]->format('Parado por %m meses e %d dias')}}</td>
                    @elseif($product[1]->y==1)
                        <td>{{$product[1]->format('Parado por %y ano , %m meses e %d dias')}}</td>
                    @elseif($product[1]->y>1)
                        <td>{{$product[1]->format('Parado por %y anos, %m meses e %d dias')}}</td>
                    @else
                        <td>Never been requested</td>
                    @endif

                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
</body>
</html>
