<?php include "db.php"; ?>

<form method="POST" enctype="multipart/form-data">

<select name="type">
 <option>dog</option>
 <option>cat</option>
</select>

<textarea name="desc"></textarea>

<input type="file" name="image">

<input type="hidden" name="lat" id="lat">
<input type="hidden" name="lng" id="lng">

<button name="save">Submit</button>

</form>

<script>
navigator.geolocation.getCurrentPosition(function(pos){
 document.getElementById("lat").value = pos.coords.latitude;
 document.getElementById("lng").value = pos.coords.longitude;
});
</script>

<?php
if(isset($_POST['save'])){

$image = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$image);

$conn->query("INSERT INTO pets(animal_type,description,image,lat,lng)
VALUES('$_POST[type]','$_POST[desc]','$image','$_POST[lat]','$_POST[lng]')");
}
?>