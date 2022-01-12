<!DOCTYPE html>
<html>
    <head>
        <?php session_start(); ?>
        <title>F.A.L.C.O.N.</title>
        <meta charset="utf-8">
        <meta lang="en-us">
        <link rel="stylesheet" type="text/css" href="../res/style.css">
    </head>
    <body onload="startTime()">
        <div class="management">
            <div class="frame">
                <div class="gridbox" style="background: linear-gradient(0deg, green 50%, #71b7e6 50%);">

                </div>
                <div class="gridbox">
                    <p id="clock"></p>
                    <script>
                        function startTime() {
                            const today = new Date();
                            let h = today.getHours();
                            let m = today.getMinutes();
                            m = checkTime(m);
                            document.getElementById('clock').innerHTML =  h + "<br>" + m;
                            setTimeout(startTime, 1000);
                        }

                        function checkTime(i) {
                            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
                            return i;
                        }
                    </script>
                </div>
                <div class="gridbox">

                </div>
                <div class="gridbox">

                </div>
                <div class="gridbox">

                </div>
                <div class="gridbox">

                </div>
                <div class="gridbox">

                </div>
                <div class="gridbox">

                </div>
                <div class="gridbox">

                </div>
                <div class="gridbox">

                </div>
            </div>
        </div>
    </body>
</html>