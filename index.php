<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">    
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">    


    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map 
        {
            width:70%;
            height: 580px;
            border:1px solid gray;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body 
        {
            height: 80%;
            margin: 0;
            padding: 0;
        }

    </style>

    
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="JS/markers.js" type="text/javascript" ></script>
    <script src="JS/main.js" type="text/javascript" ></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCu21-mGj3ZhP6z5Oi7tVefQuCDXy2JLFE&callback=initMap" async defer></script>

</head>
<body>

    <p>Test2</p>    

    <textarea id="debugging" style="display:none;width:100%" >debug</textarea>

    <div><!-- style="border:1px solid gray" >-->

        <div style="float:left;width:250px;margin-left:10px;margin-right:10px" >

            <div class="input-group mb-3" >
                <input id="pinCode" type="text" class="form-control" placeholder="Postcode" aria-label="Postcode" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="mapUtility.search()" >Search</button>
                </div>
            </div>

            <div class="input-group mb-3" >
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">State</label>
                </div>
                <select class="custom-select" id="selectState" onchange="mapUtility.onStateChange()" >
                    <option selected>Choose...</option>
                </select>
            </div>

            <div class="input-group mb-3" >
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">City</label>
                </div>
                <select class="custom-select" id="selectCity" onchange="mapUtility.onCityChange()" >
                    <option selected>Choose...</option>
                </select>
            </div>

            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked> 1 KM
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option2" autocomplete="off"> 2 KM
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option3" autocomplete="off"> 5KM
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option3" autocomplete="off"> 10KM
                </label>
            </div>

            <!-- <div style="margin-top:4px" >
                <ul id="listResult" style="border:1px solid gray;height:400px;width:100%;overflow:auto" >
                </ul>
            </div>  -->

            <div class="row" style="border:1px solid gray;height:400px;width:100%;overflow:auto;margin-left:0;margin-top:4px">
                <div class="col-4" style="padding:0" >
                    <div class="list-group" id="listResult" role="tablist">

                    </div>
                </div>
            </div>

        </div>

        <div id="map"></div>

    </div>

</body>
</html>