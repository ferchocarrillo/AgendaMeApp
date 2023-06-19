<html>
<head>
    <title>Laravel Signature Pad Example - MyNotePaper.com</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <style>
        .kbw-signature {
            width: 380px;
            height: 200px;
        }
        h5{
            text-align: center;
            text-transform: uppercase;
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('signpad.save') }}">
                            @csrf
                            <div class="form-group">
                                <label class="" for="doctor">Doctor:</label>
                                <span class="float-right" style="color: black">{{ $appointment->doctor->name }}</span>
                                <input type="hidden" name="id" id="id" value="{{ $appointment->id }}">
                                <input type="hidden" name="doctor" class="form-control"  value="{{ $appointment->doctor->name }}">
                           </div>
                            <div class="form-group">
                                 <label class="" for="paciente">Paciente:</label>
                                 <span class="float-right" style="color: black">{{ $appointment->patient->name }}</span>
                                 <input type="hidden" name="paciente" class="form-control"  value="{{ $appointment->patient->name }}">
                            </div>

                            <div class="form-group">
                                <label for="procedimiento" class="col-form-label">Procedimiento</label>
                                <div class="col">
                                    <input type="checkbox" name="tratamiento[]" value="toxina botulinica"
                                        id="">&nbsp;<label for="">Aplicación de toxina
                                        botulinica</label><br>
                                    <input type="checkbox" name="tratamiento[]" value="acido hialuronico"
                                        id="">&nbsp;<label for="">Aplicacion ácido
                                        hialuronico</label><br>
                                    <input type="checkbox" name="tratamiento[]" value="microdermoabracion"
                                        id="">&nbsp;<label for="">Microdermoabración</label><br>
                                    <input type="checkbox" name="tratamiento[]" value="peling quimico"
                                        id="">&nbsp;<label for="">Peling químico</label><br>
                                    <input type="checkbox" name="tratamiento[]" value="crioterapia"
                                        id="">&nbsp;<label for="">Crioterapia</label><br>
                                    <input type="checkbox" name="tratamiento[]" value="biopsia"
                                        id="">&nbsp;<label for="">Biopsia</label><br>
                                    <input type="checkbox" name="tratamiento[]" value="infiltracion"
                                        id="">&nbsp;<label for="">Infiltración</label>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Dia del procedimiento:</label>
                                    <input class="form-control" type="date" name="fecha" id="">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Advertencias y/o
                                        contraindicaciones</label>
                                    <textarea class="form-control" name="indicaciones" id="message-text"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label>Firma paciente:</label>
                                    <br/>
                                    <div id="sig"></div>
                                    <br/><br/>
                                    <button id="clear" class="btn btn-danger btn-sm">Clear</button>
                                    <textarea id="signature" name="signed" style="display: none"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label>Firma testigo:</label>
                                    <br/>
                                    <div id="testigo"></div>
                                    <br/><br/>
                                    <button id="clear2" class="btn btn-danger btn-sm">Clear</button>
                                    <button class="btn btn-primary">Save</button>
                                    <textarea id="signature2" name="signedtestigo" style="display: none"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
        $('#clear').click(function (e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });


        var testigo = $('#testigo').signature({syncField: '#signature2', syncFormat: 'PNG'});
        $('#clear2').click(function (i) {
            i.preventDefault();
            testigo.signature('clear');
            $("#signature64").val('');
        });
    </script>
</body>
</html>
