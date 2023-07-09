<!doctype html>
<html lang="en">

<head>
    <title>CONSENTIMIENTO INFORMADO PARA INTERVENCION QUIRURGICA</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>

        .p_1_top {
            margin-top: 7rem;
            margin-left: 9rem;
            margin-right: 9rem;
            text-align: justify;
        }
        .p_1_lat {

           float: right;
            margin-right: 9rem;
            text-align: justify;
        }
        .hr-top {
            color: black;
            width: 1000px;
            border-top: 2px solid #534444;
            margin-left: 8rem;
        }

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
            margin-top: -3rem;
        }
        .p_2a {
            margin-left: 9rem;
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

        .hr-3 {
            color: black;
            width: 350px;
            border-top: 2px solid #534444;
            margin-left: 48rem;
            margin-top: -1rem;
        }
        .fir_paciente{
            filter: brightness(1.1);
            mix-blend-mode: multiply;
            position: absolute;
            margin-left: 12rem;
            margin-top:1rem;
            width: 20%;
        }

        .fir_medico{
            filter: brightness(1.1);
            mix-blend-mode: multiply;
            position: absolute;
            margin-left: 48rem;
            margin-top: -1rem;
            width: 30%;
        }
        .sello{
            filter: brightness(1.1);
            mix-blend-mode: multiply;
            position: absolute;
            margin-left: 48rem;
            margin-top: 1rem;
            width: 20%;
        }
        .firmas{

            margin-top: 7rem;
        }
        .p_footer{

            text-align: center;
        }
    </style>
</head>
<body>
    <p class="p_1_top">Dra. Olga Patricia Escobar Gil</p>
    <p class="p_1">Dermatologa</p>
    <p class="p_1_lat">Consentimiento informado</p>
    <br>
    <hr class="hr-top">
    <p class="titulo1">CONSENTIMIENTO INFORMADO PARA INTERVENCION QUIRURGICA O PROCEDIMENTAL ESPECIAL</p>
    <p class="p_1">Por la presente autorizo a la profesional <strong> Olga Patricia Escobar Gil </strong>y los asistentes de su elección, a realizar en mi o en el(la) paciente <strong> {{ $firmas->paciente }} </strong>
    el(los) siguiente(s) procedimiento(s) especial:
    <p class="p_1">
        @foreach (json_decode($firmas->tratamiento) as $frm)
            <li class="listado">{{ $frm }}</li>
        @endforeach
    </p>
    </p>
    <p class="p_1">La doctora: <Strong>OLGA PATRICIA ESCOBAR GIL</Strong></p>
    <p class="p_1"> han explicado la naturaleza y proposito del procedimiento especial, tambien me ha informado de los riesgos inherentes a la intevencion propuesta y en especial:</p>
    <p class="p_1"><strong> (INFECCION, SANGRADO, DOLOR, NECESIDAD DE REINTERVENCION, CICATRIZ, HEMATOMA, MUESTRA INSUFICIENTE, MANCHA MAS CLARA O MAS OSCURA, DEHISCENCIA DE LA SUTURA)</strong></p>
    <br><br>
    <p class="p_1">Tambien se me ha informado de las alternativas de tratamiento existentes y de las ventajas del procedimiento a realizar.
        Asi mismo, se me ha explicado que o es posible garantizar los resultados esperados con este procedimiento.
    </p>
    <br>
    <p class="p_1">Tambien se ma ha informado y entiendo que en el curso de la intervencion propuesto pueden presentarse acciones imprevistas que requieran procedimientos adicionales.
        Por lo tanto, autorizo la realizacion de dichos procedimientos si el profesional tratante lo juzga conveniente.
    </p>
    <br>
    <p class="p_1">Tambien se ma ha dado la oportunidad de hacer preguntas y todas ellas han sido contestadas satisfactoriamente.</p>
    <div class="p_1">Manifiesto que he recibido y comprendido toda la informacion respecto al orocedimiento propuesto y todos los espacios en blanco han sido llenados antes de mi firma y que me encuentro en pleno uso de mis facultades para dar mi consentimiento </div>
    <div class="row firmas">
        <hr class="hr-1 firmas">
        <hr class="hr-3">
        <img class="fir_paciente" src="{{asset('storage/'.$firmas->signature )}}" />
        <img class="sello" src="{{asset( 'storage/'.'SELLO.png' ) }}" />
        <img class="fir_medico" src="{{asset( 'storage/'.'fr_patricia.png' ) }}" />
    </div>
    <div class="row"></div>
        <p class="p_2">Firma del paciente o persona responsable</p>
        <p class="p_3">Firma del medico y numero de registro</p>
    </div>
    <div class="row">
        <p class="p_2a">C.C. {{$firmas->cedula1 }}</p>
    </div>
    <p class="p_footer"> Carrera 16 # 82 - 29 consultorio 309 edificiocntro profesional del country</p>
    <p class="p_footer"> Telefonos: 6164212 - 6164248</p>
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
