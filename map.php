<!DOCTYPE html>
<html>
<body>

<h3>🐾 Animal Map</h3>

<select id="filter">
 <option value="all">All</option>
 <option value="dog">Dogs</option>
 <option value="cat">Cats</option>
</select>

<div id="map"></div>

<script>
function loadMap(type){
 fetch("map_data.php?type="+type)
 .then(res=>res.json())
 .then(data=>{
   console.log(data); // pins
 });
}

document.getElementById("filter").onchange=function(){
 loadMap(this.value);
}
</script>

</body>
</html>