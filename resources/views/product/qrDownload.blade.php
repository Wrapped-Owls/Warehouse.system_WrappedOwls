<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    @foreach($relation as $key=>$value)

                <h1 class="page-header">{{$value[1]->name}}</h1>

        @foreach(range(0,$value[0]-1) as $i)

        <img src="data:image/png;base64,{!!  base64_encode(QrCode::format('png')->size(100)->generate(route("main") . "/product/{$key}/detail")); !!}"/>
        @endforeach
    @endforeach
        </div>
    </div>

</div>
</body>
</html>
