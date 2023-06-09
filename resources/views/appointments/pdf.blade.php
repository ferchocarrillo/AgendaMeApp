<!doctype html>
<html lang="en">

<head>
    <title>CONSENTIMIENTO PARA PROCEDIMIENTOS NO QUIRURGICOS</title>
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
            margin-bottom: 3rem;
            font-family: 'Raleway', sans-serif;
            align-self: center;
            font-weight: bold;
        }
        .p_1 {
            margin-left: 9rem;
            margin-right: 9rem;
            text-align: justify;
        }
        .p_1a {
            margin-top: 7rem;
            margin-left: 9rem;
            margin-right: 9rem;
            text-align: justify;
        }
        .p_2 {
            margin-left: 9rem;
            margin-right: 9rem;
            text-align: justify;
        }
        .p_3 {
            margin-left: 48rem;
            margin-right: 9rem;
            text-align: justify;
        }
        .p_2a {
            margin-left: 23rem;
            margin-right: 9rem;
            text-align: justify;
        }
        .p_2b {
            margin-left: 11rem;
            margin-right: 9rem;
            text-align: justify;
        }
        .listado {
            margin-left: 12rem;
        }
        .hr-1 {
            color: black;
            width: 350px;
            border-top: 2px solid #534444;
            margin-left: 8rem;
        }
        .hr-2 {
            color: black;
            width: 350px;
            border-top: 2px solid #534444;
            margin-left: 46rem;
            margin-top: -1rem;
        }
        .hr-3 {
            color: black;
            width: 350px;
            border-top: 2px solid #534444;
            margin-left: 48rem;
            margin-top: 3rem;
        }
        .fir_paciente{
            filter: brightness(1.1);
            mix-blend-mode: multiply;
            position: absolute;
            margin-left: 12rem;
            margin-top: -4rem;
            width: 20%;
        }
        .fir_testigo{
            filter: brightness(1.1);
            mix-blend-mode: multiply;
            position: absolute;
            margin-left: 52rem;
            margin-top: -4rem;
            width: 20%;
        }
        .fir_medico{
            filter: brightness(1.1);
            mix-blend-mode: multiply;
            position: absolute;
            margin-left: 48rem;
            margin-top: -4rem;
            width: 30%;
        }
        .sello{
            filter: brightness(1.1);
            mix-blend-mode: multiply;
            position: absolute;
            margin-left: 48rem;
            margin-top: -4rem;
            width: 20%;
        }
        .acot{
            text-align: justify;
            margin-left: 8rem;
            margin-right: 8rem;
            border: 1px solid #000;
            padding-top: 3rem;
            padding-bottom: 3rem;
            padding-left: 1rem;
            padding-right: 1rem;

        }
    </style>


</head>

<body>
    <p class="titulo1">AUTORIZACION DE CONSENTIMIENTO PARA PROCEDIMIENTOS NO QUIRURGICOS</p>



    <p class="p_1"><strong>1. </strong> Por la presente autorizo al Doctor(a) {{ $firmas->doctor }} a realizar a mi en el(la)
        {{ $firmas->paciente }} el siguiente procedimiento
    </p>
    <p class="p_1">
        @foreach (json_decode($firmas->tratamiento) as $frm)
            <li class="listado">{{ $frm }}</li>
        @endforeach
    </p>

    <div class="p_1">
        <p>Que se llevaran a cabo el dia {{ strftime('%A %e de %B de %Y a las', strtotime($firmas->fecha)) }}
            {{ $firmas->hora }}. </p>
    </div>

    <p class="p_1"><strong>2.</strong> El Doctor(a) {{ $firmas->doctor }} me ha explicado la naturaleza y proposito del procedimiento
        especial, tambien me ha informado las ventajas, complicaciones, molestias, posibles alternativas y riesgos, en
        particular los siguientes:
        {{ $firmas->indicaciones }}
    </p>
    <br>
    <p class="p_1">Se me ha dado la oportunidad de hacer preguntas y todas ellas han sido contestadas
        satisfactoriamente, asi mismo se me ha explicado que no es posible garantizar los resultados esperados con el
        procedimiento.</p>
    <br>
    <p class="p_1"><strong>3.</strong> Finalmente manifiesto que he leido y comprendido perfectamente lo anterior y que todos los
        espacios en blanco han sido completados antes de mi firma y que me encuentro en capacidad de expresar mi
        consentimiento.
    </p>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <hr class="hr-1">
        <img class="fir_paciente" src="{{asset('storage/'.$firmas->signature )}}" />
        <hr class="hr-2">
        <img class="fir_testigo" src="{{asset('storage/'.$firmas->signature2 ) }}" />
    </div>
    <div class="row">
        <p class="p_2">Firma del paciente o persona responsable</p>
        <p class="p_2b">Firma del testigo</p>

        <p class="p_2">C.C. {{$firmas->cedula1 }}</p>
        <p class="p_2a">C.C. {{$firmas->cedula2 }}</p>
    </div>
    <br><br>


    <p class="p_1">*Parentezco si firma una persona que no es el paciente</p>
    <p class="acot"> Dejo contancia que he explicado la naturaleza, propositos, ventajas, riesgos y altenativas del procedimiento especialcitado en el numerl 1.
    Y he contestado todas las preguntas que el paciente o persona responsable me ha formulado.</p>

<p class="p_1a">Fecha: {{ strftime('%e de %B de %Y', strtotime($now))}}</p>

<div class="row">

    <hr class="hr-3">
    <img class="fir_medico" src="{{asset( 'storage/'.'fr_patricia.png' ) }}" />
    <img class="sello" src="{{asset( 'storage/'.'SELLO.png' ) }}" />
</div>
<div class="row">

    <p class="p_3">Firma del medico y numero de registro</p>
    <br>
    <br>
    <br>


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
