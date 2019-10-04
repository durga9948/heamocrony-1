<!DOCTYPE HTML>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<? php include "homeHeamocrony.html" ?>
	<title>
		Donar form
	</title>
	<style>
		form{
				padding-left:50px;
				margin-right:400px;
				margin-top:50px;
				border: 7px solid #f1f1f1;
				margin-left:500px;
				background-color: #ffffa0;
				
			}
			input[type=text] ,input[type=date] ,input[type=email], input[type=tel]
			{
				background-color: #f1f1f1;
				width:50%;
			}
			select
			{
				background-color: #f1f1f1;
			}
			
			@media screen and (max-height:1200px)
			{
				.form{
					margin-left: 100px;
					margin-right: 100px;
				}
			}
	</style>
	<script type="text/javascript" src="DonarPageJS.js"></script>
</head>
<body>
<form  id=donarform action="donorPage.php" method="post">
	<h3 style="color: red ;text-align: center;" > BLOOD DONOR FORM </h3>
	<b>Name:</b>
	
    	<i class="fa fa-user icon"></i>
		<input type="text"  name="name" required autofocus style="border-radius: 5px;"><br>
	<br>
	<b>Date of Birth:</b>
		<i class="fa fa-calender-alt"></i>
		<input type="date" name="date" required max=sysdate() style="border-radius: 5px;"><br>
	<br>
	<b>Phone number:</b><br>
		<i class="fa fa-mobile-phone icon"style="font-size:25px;"></i>
		<input type="tel" name ="phno" pattern="[0-9]{10}" required>
		<span id="phnov"> enter a 10-digit number</span>
	<br>
	<br>
	<b>Email:</b>
    	<i class="fa fa-envelope icon"></i>
		<input type="email" name="mail"><br>
		<br>
	<b>Gender:<br></b>
		<input type="radio" name="gender" value=" male" > Male <br>
		<input type="radio" name="gender" value=" Female" > Female <br>
		<input type="radio" name="gender" value=" other"> other <br>
	<br>
	<b>Blood Group</b>
		<select name="BloodGroup" required>
			<option value="A+" > A+ </option>
			<option value="A-"> A- </option> 
			<option value="B+"> B+ </option> 
			<option value="B-"> B- </option> 
			<option value="AB+"> AB+ </option> 
			<option value="AB-"> AB- </option> 
			<option value="O+"> O+ </option> 
			<option value="O-"> O- </option> 
		</select>
	<br>
	<br>
	<b>Address:</b>
	<br>
		<input type="text" id="location-input" name="address">
	<br>
	<div id="geometry"></div><br>
<!--<button>submit</button>-->
	<button type="submit">submit</button>
	<br>
	<br>

	</form>
	  <script>
    // Call Geocode
    //geocode();

    // Get location form
    var locationForm = document.getElementById('donarform');

    // Listen for submiot
    donarForm.addEventListener('submit', geocode);

    function geocode(e){
      // Prevent actual submit
      e.preventDefault();

      var location = document.getElementById('location-input').value;

      axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
        params:{
          address:location,
          key:'AIzaSyA0Bctx4ZuHrXe64prJ0wj3uZwGWSgtlhQ'
        }
      })
      .then(function(response){
        // Log full response
        console.log(response);

        // Formatted Address
        /*var formattedAddress = response.data.results[0].formatted_address;
        var formattedAddressOutput = `
          <ul class="list-group">
            <li class="list-group-item">${formattedAddress}</li>
          </ul>
        `;*/

        // Address Components
        /*var addressComponents = response.data.results[0].address_components;
        var addressComponentsOutput = '<ul class="list-group">';
        for(var i = 0;i < addressComponents.length;i++){
          addressComponentsOutput += `
            <li class="list-group-item"><strong>${addressComponents[i].types[0]}</strong>: ${addressComponents[i].long_name}</li>
          `;
        }
        addressComponentsOutput += '</ul>';*/

        // Geometry
        var lat = response.data.results[0].geometry.location.lat;
        var lng = response.data.results[0].geometry.location.lng;
        var geometryOutput = `
          <ul class="list-group">
            <li class="list-group-item"><strong>Latitude</strong>: ${lat}</li>
            <li class="list-group-item"><strong>Longitude</strong>: ${lng}</li>
          </ul>
        `;

        // Output to app
        //document.getElementById('formatted-address').innerHTML = formattedAddressOutput;
        //document.getElementById('address-components').innerHTML = addressComponentsOutput;
        document.getElementById('geometry').innerHTML = geometryOutput;
      })
      .catch(function(error){
        console.log(error);
      });
    }
  </script>
	</body>
</html>