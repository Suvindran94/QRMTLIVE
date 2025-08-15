<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="description" content="">
    <meta name="author" content="">
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/html2canvas.min.js" type="text/javascript"></script>
    <script src="js/html2canvas.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
    <!-- Bootstrap CSS -->


    <!-- Custom styles for this template -->

    <title>Polyware | Your Complete PE Pipeline System Partner</title>
    <!-- Bootstrap core CSS -->
    @if( auth()->check() )
 @include ('Navigation.'.auth()->user()->dept)  
@endif
</head>
<br><br><br><br><br><br>
<style>
body {
    background-image: url('/img/back.jpg');
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color: #464646;
}

* {
    box-sizing: border-box;
}

form.example input[type=text] {
    padding: 10px;
    font-size: 17px;
    border: 0px solid grey;
    float: left;
    width: 80%;
    background: #f1f1f1;
    border-radius: 20px;
}

form.example button {
    float: left;
    width: 20%;
    height: 7.5%;
    padding: 10px;
    background: #2196F3;
    color: white;
    font-size: 17px;
    border: 0px solid grey;
    border-left: none;
    cursor: pointer;
    border-radius: 100px;

}

form.example button:hover {
    background: #0b7dda;
}

form.example::after {
    content: "";
    clear: both;
    display: table;
}

div.card {
    width: 56%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    text-align: center;
    margin-left: 23%;


}

div.header {
    background-color: white;
    color: white;
    height: 450px;
    padding: 10px;
    font-size: 40px;
    border-radius: 20px;
}


.button {
    background-color: #4CAF50;
    /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    /* Safari */
    transition-duration: 0.4s;
    align: center;
}

.button1 {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    text-align: center;
}

#mydiv {
    position: absolute;
    z-index: 9;
    background-color: #f1f1f1;
    text-align: center;
    border: 1px solid #d3d3d3;
}

#mydivheader {
    padding: 10px;
    cursor: move;
    z-index: 10;
    background-color: #2196F3;
    color: #fff;
}
</style>

<body>

    <!--<div class="header">
            <div id="mydiv" style="text-align:center">
                <img src="{{ asset('/img/barcode.jpg') }}" alt="">
            </div>
        </div>
        -->
    <style>
    * {
        box-sizing: border-box;
    }

    /* force scrollbar */
    html {
        overflow-y: scroll;
    }

    body {
        font-family: sans-serif;
    }

    /* ---- grid ---- */

    .grid {
        max-width: 700x;
        background: white;
    }

    /* clear fix */
    .grid:after {
        content: '';
        display: block;
        clear: both;
    }

    /* ---- .grid-item ---- */

    .grid-sizer {
        width: 10%;
    }

    .grid-item {
        width: 30%;

    }

    .grid-item {
        padding-bottom: 25%;
        /* hack for proportional sizing */


        background-repeat: no-repeat;

        background-position: center;
    }

    .grid-item--width1 {
        width: 20%;
        height: 10%;
        padding-bottom: 15%;
    }

    .grid-item--width2 {
        width: 90%;
    }
    .grid-item--width3 {
        width: 40%;
        padding-bottom: 5%;
    }

    .grid-item--large {
        width: 50%;
        padding-bottom: 50%;
    }

    .packery-drop-placeholder {
        border: 3px dotted #333;
        background: hsla(0, 0%, 0%, 0.3);
    }

    .grid-item.is-dragging,
    .grid-item.is-positioning-post-drag {
        z-index: 2;
    }
    </style>

    <div id="html-content-holder">
        <div class="card">
            <div style="text-align:center">
               

               
            </div>
             <div class="grid">
                <div class="grid-sizer">
                    <div class="grid-item  grid-item--width1 " data-item-id="1"
                        style="background-image: url('/img/barcodetemplate/fta.png');"></div>

                    <div class="grid-item  grid-item--width1" data-item-id="2"
                        style="background-image: url('/img/barcodetemplate/item.png');"></div>
                    <div class="grid-item  grid-item--width1" data-item-id="3"
                        style="background-image: url('/img/barcodetemplate/penguinlogo.png');"></div>
                    <div class="grid-item grid-item--width2" data-item-id="4"
                        style="background-image: url('/img/barcodetemplate/item3.png');">
                    </div>
                    <div class="grid-item grid-item--width3" data-item-id="5"
                        style="background-image: url('/img/barcodetemplate/so2.png');"></div>
                    <div class="grid-item grid-item--width3" data-item-id="6"
                        style="background-image: url('/img/barcodetemplate/sm.png');"></div>
                    <div class="grid-item  grid-item--width1" data-item-id="7"
                        style="background-image: url('/img/barcodetemplate/qc.png');"></div>
                    <div class="grid-item  grid-item--width1" data-item-id="8"
                        style="background-image: url('/img/barcodetemplate/mly.png');"></div>
                    <div class="grid-item  grid-item--width1" data-item-id="9"
                        style="background-image: url('/img/barcodetemplate/iso.png');"></div>
                    <div class="grid-item  grid-item--width1" data-item-id="10">
                   
                  
                    </div>
                  
                </div>  
            </div>
           


        </div>

    </div>


    <center>
        <a id="btn-Preview-Image" href="#"><button class="button button1">Save</button></a>
        <a id="btn-Convert-Html2Image" href="#"><button class="button button1">Download</button></a>
    </center>
    <script>
    var element = $("#html-content-holder"); // global variable
    var getCanvas; // global variable

    $("#btn-Preview-Image").on('click', function() {
        html2canvas(element, {
            onrendered: function(canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
            }
        });
    });
    $("#btn-Convert-Html2Image").on('click', function() {
        var imgageData = getCanvas.toDataURL("image/png");
        // Now browser starts downloading it instead of just showing it
        var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
        $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
    });
    (function() {
        function IDGenerator() {

            this.length = 8;
            this.timestamp = +new Date;

            var _getRandomInt = function(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            this.generate = function() {
                var ts = this.timestamp.toString();
                var parts = ts.split("").reverse();
                var id = "";

                for (var i = 0; i < this.length; ++i) {
                    var index = _getRandomInt(0, parts.length - 1);
                    id += parts[index];
                }

                return id;
            }


        }


        document.addEventListener("DOMContentLoaded", function() {
            var btn = document.querySelector("#generate"),
                output = document.querySelector("#output");

            btn.addEventListener("click", function() {
                var generator = new IDGenerator();
                output.innerHTML = generator.generate();

            }, false);

        });


    })();
    </script>

    <br><br>
    <script>
   //Make the DIV element draggagle:
    dragElement(document.getElementById("mydiv"));

    function dragElement(elmnt) {
        var pos1 = 0,
            pos2 = 0,
            pos3 = 0,
            pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
            /* if present, the header is where you move the DIV from:*/
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
            /* otherwise, move the DIV from anywhere inside the DIV:*/
            elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }
    </script>
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://npmcdn.com/packery@2/dist/packery.pkgd.js'></script>
    <script src='https://npmcdn.com/draggabilly@2/dist/draggabilly.pkgd.js'></script>
    <script src="js/drag.js"></script>
</body>
@include('Navigation.footer2')

</html>