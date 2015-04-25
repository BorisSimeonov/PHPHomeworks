<select name="continent" onchange="changeCountries(this.value)">
    <option value="blank"></option>
    <option value="europe">Europe</option>
    <option value="asia">Asia</option>
    <option value="africa">Africa</option>
    <option value="namerica">North America</option>
    <option value="samerica">South America</option>
    <option value="australia">Australia</option>
</select>
<select name="country" id="countries">
    <option value="blank"></option>
</select>

<script>
    var countries = {"australia":["Australia"], "africa":["South Africa", "Egypt"],
        "europe":["Germany", "Bulgaria", "Italy"], "asia":["China"], "namerica":["Canada", "United States"],
        "samerica":["Argentina", "Brazil", "Peru", "Paraguay", "Guyana", "Venezuela", "Suriname", "Chile"]};
    function changeCountries(value){
        document.getElementById('countries').innerHTML = "<option value='blank'></option>";
        var countryArray = countries[value];
        for(var cnt = 0; cnt<countryArray.length; cnt++){
            var newOption = document.createElement("option");
            newOption.value = countryArray[cnt];
            newOption.innerHTML = countryArray[cnt];
            document.getElementById('countries').appendChild(newOption);
        }
    }
</script>