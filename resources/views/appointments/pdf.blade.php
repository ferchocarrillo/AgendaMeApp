<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .titulo1 {
            text-align: center;
            font-size: 16px;
            margin-top: 8rem;
            margin-left: 5rem;
            font-family: 'Raleway', sans-serif;
            align-self: center;
        }

        .p_1 {

            margin-left: 7rem;
        }

        .listado {

            margin-left: 12rem;
        }
    </style>
</head>

<body>
    <p class="titulo1">AUTORIZACION DE CONSENTIMIENTO PARA PROCEDIMIENTOS NO QUIRURGICOS</p>



    <p class="p_1">1. Por la presente autorizo al Doctor(a) {{ $firmas->doctor }} a realizar a mi en el(la)
        {{ $firmas->paciente }} el siguiente procedimiento
    </p>
    <p class="p_1">
        @foreach (json_decode($firmas->tratamiento) as $frm)
            <li class="listado">{{ $frm }}</li>
        @endforeach
    </p>

    <div class="p_1">
        <p>Que se llevaran a cabo el dia  {{ date('d M Y', strtotime($firmas->fecha)) }}</p>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
