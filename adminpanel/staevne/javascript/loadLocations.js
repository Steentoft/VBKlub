function LoadLocations(id) {
$.ajax({
    url: 'staevne/php/loadLocations.php',
    success:function(data){
        var Locations = JSON.parse(data);
        var select =  document.getElementById(id);
        $(select).empty();
        if(document.querySelector('[id*="LocationSelect"]')){
            var NewLocation = document.createElement("option");
            NewLocation.innerHTML = "Ny Lokation"
            NewLocation.id = "NewLocation";
            select.appendChild(NewLocation);
        }
        Locations.forEach((Location) => {
            var a = 0;
            var option = document.createElement("option");
            option.innerHTML = Location.location;
            option.id = Location.id;
            for (var i = 0; i < select.length; ++i){
                if (select.options[i].innerHTML == option.innerHTML){
                    a = 1;
                }
            }
            if(a == 0){
                select.appendChild(option);
            }
        });
    }
});
}