<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{url('style.css')}}">

        <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    </head>
    <body style="background:{{  $settingsPdfReport['colorPage']?$settingsPdfReport['colorPage'] : '#BC9B78' }} ">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="d-none d-md-flex col-md-4 col-lg-6 " style=" background-image: url({{  $settingsPdfReport['background']?$settingsPdfReport['background']:'https://s3-us-west-2.amazonaws.com/s.cdpn.io/28963/form-bk.jpg' }}); height: 1000px;"></div>
                <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 mx-auto">

                                    <div class="mb-4" style="background:{{  $settingsPdfReport['colorPage']?$settingsPdfReport['colorPage']:'#BC9B78' }} ; padding: 15px;">
                                        <h3 class="login-heading" style="margin-bottom: 50px;">Welcome {{ ucfirst(Auth()->user()->name) }} !</h3>
                                        <div class="row ">

                                            @if($signature)
                                            @php
                                            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
                                            $domainName = $_SERVER['HTTP_HOST'] . '/';
                                            @endphp
                                            <div class="col-md-12 mt-4">
                                                <div class="col-md-12 grid-margin stretch-card">
                                                    <div class="card_">
                                                        <div class="card-body ">

                                                            Your signature: 

                                                            <img  width="130" height="90"class="img-fluid img-thumbnail signatureBox m-8" src="{{ $protocol }}://{{ $domainName }}storage/app/public/ratrak/{{Auth::user()->id}}/thumbnail/{{ $signature }}" alt="Signature Thumbnail">

                                                            <div class="col-md-12" style="margin:20px 0 ;">
                                                                <a href="{{ route('toPdf') }}"role="button">
                                                                    <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" style="font-size:16px;" type="submit">
                                                                        Generate report
                                                                    </button>
                                                                </a>
                                                            </div>
                                                            <div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if(!$signature)
                                                    <div class="col-md-12">
                                                        <div class="col-md-12 grid-margin stretch-card">
                                                            <div class="card_">
                                                                <div class="card-body">


                                                                    <div style="clear: left;">
                                                                        <h5 class="text-dark">
                                                                            Please, define the signature to generate report.
                                                                        </h5>

                                                                        <div id="signature-pad">
                                                                            <div style="border: solid 1px black; margin-bottom: 10px">
                                                                                <canvas id="jay-signature-pad" style="width: 100%; height: 20%;"></canvas>
                                                                            </div>
                                                                            <div class="txt-center ">
                                                                                <div class=""> Sign Above 
                                                                                    <button class="btn btn-danger btn-xs button clear float-right ml-2 mt-1 mr-1" role="button" data-action="clear">Clear</button>
                                                                                    <button class="btn btn-success btn-xs button save float-right mt-1" role="button" data-action="save-png">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 grid-margin stretch-card">
                                                            <div class="card_" style="border: none;">
                                                                <div class="card-body p-2">
                                                                    <div class="row">
                                                                        <div class="col-md-12 grid-margin stretch-card">
                                                                            <div class="card_" style="border: none;">
                                                                                <div class="card-body p-2">                
                                                                                    <h5 class="text-dark">
                                                                                        Description: 
                                                                                    </h5>
                                                                                    <p>
                                                                                        An e-signature (electronic signature) is a digital version of a traditional pen and ink signature.
                                                                                    </p>
                                                                                    <p>
                                                                                        The terms e-signature and digital signature are often confused and used incorrectly as synonyms by laymen. 
                                                                                        A digital signature is a type of e-signature that uses mathematics to validate the authenticity and integrity of a message, 
                                                                                        software or digital document.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="row pt-5">
                                                    <div class="col-md-4">
                                                        <a  href="{{url('logout')}}">Logout</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </body>
                </html>
                <style>
                    .bg-image_{}
                </style>

                <script>
$(function () {

    /**
     * Add Signature
     */
    var wrapper = document.getElementById("signature-pad");
    var clearButton = wrapper.querySelector("[data-action=clear]");
    var savePNGButton = wrapper.querySelector("[data-action=save-png]");
    var canvas = wrapper.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)'
    });
    window.onresize = resizeCanvasSignature;
    resizeCanvasSignature(canvas, signaturePad, window);
    clearButton.addEventListener("click", function (event) {
        signaturePad.clear();
    });
    savePNGButton.addEventListener("click", function (event) {
        if (signaturePad.isEmpty()) {
            alert("Please provide a signature first.");
        } else {
            var dataURL = signaturePad.toDataURL();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "PUT",
                url: "/public/saveSignature",
                data: {
                    dataURL: dataURL,
                    userId: $('#signature-pad').attr('userId')
                },
                beforeSend: function () {
                },
                success: function () {
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    });
});
/**
 * Add Signature END
 */

function resizeCanvasSignature(canvas, signaturePad, window) {
    if (window.devicePixelRatio != undefined) {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);

        signaturePad.clear();
    }
}

function download(dataURL, filename) {
    var blob = dataURLToBlob(dataURL);
    var url = window.URL.createObjectURL(blob);
    var a = document.createElement("a");
    a.style = "display: none";
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    window.URL.revokeObjectURL(url);
}

function dataURLToBlob(dataURL) {
    var parts = dataURL.split(';base64,');
    var contentType = parts[0].split(":")[1];
    var raw = window.atob(parts[1]);
    var rawLength = raw.length;
    var uInt8Array = new Uint8Array(rawLength);
    for (var i = 0; i < rawLength; ++i) {
        uInt8Array[i] = raw.charCodeAt(i);
    }
    return new Blob([uInt8Array], {type: contentType});
}
                </script>