<?php include "../templates/header.php"; ?>
<div class="table-responsive-sm">
<table class="table table-striped table-responsive-sm">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Navn</th>
        <th scope="col">Dato</th>
        <th scope="col">Start tid</th>
        <th scope="col">Stop tid</th>
        <th scope="col">Lokation</th>
        <th scope="col">Rediger</th>
        <th scope="col">Slet</th>
    </tr>
    </thead>
    <tbody id="Table">
    </tbody>
</table>
    <button data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#AddConvention" id="AddConventionButton" class="btn btn-dark" >Nyt Stævne</button>
    <button data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#DeleteLocations" id="DeleteLocationsButton" class="btn btn-dark" >Slet Lokationer</button>
</div>

<!-- Style -->
<style>
    .modal-dialog{
        position: relative;
        display: table; /* This is important */
        overflow-y: auto;
        overflow-x: auto;
        width: auto;
        min-width: 300px;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="AddConvention" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Stævne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-responsive-sm">
                    <thead class="thead-dark">
                    <form method="post" id="AddConventionForm">
                        <tr>
                            <td scope="col">Navn</td>
                            <td><input id="LocationName" maxlength="255" required/></td>
                        </tr>
                        <tr>
                            <td scope="col">Dato</td>
                            <td><input id="LocationDate" type="date" required/></td>
                        </tr>
                        <tr>
                            <td scope="col">Start tid</td>
                            <td><input id="LocationStart" type="time" required/></td>
                        </tr>
                        <tr>
                            <td scope="col">Stop tid</td>
                            <td><input id="LocationEnd" type="time" required/></td>
                        </tr>
                        <tr>
                            <td scope="col">Lokation</td>
                            <td><select id="LocationSelect">
                                </select></td>
                        </tr>
                        <tr>
                            <td scope="col" id="NewLocationHidden" type="hidden">Ny Lokation</td>
                            <td type="hidden" id="NewLocationInput"><input id="LocationInput" /></td>
                        </tr>
                    </form>
                    </thead>
                    <tbody id="Table">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuller</button>
                <button type="submit" id="AddConventionSubmit" form="AddConventionForm" class="btn btn-primary">Gem Ændringer</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="EditConvention" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Stævne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-responsive-sm">
                    <thead class="thead-dark">
                    <form method="post" id="EditConventionForm">
                        <tr>
                            <td scope="col">Navn</td>
                            <td><input id="EditLocationName" maxlength="255" required/></td>
                        </tr>
                        <tr>
                            <td scope="col">Dato</td>
                            <td><input id="EditLocationDate" type="date" required/></td>
                        </tr>
                        <tr>
                            <td scope="col">Start tid</td>
                            <td><input id="EditLocationStart" type="time" required/></td>
                        </tr>
                        <tr>
                            <td scope="col">Stop tid</td>
                            <td><input id="EditLocationEnd" type="time" required/></td>
                        </tr>
                        <tr>
                            <td scope="col">Lokation</td>
                            <td><select id="EditLocationSelect">
                                </select></td>
                        </tr>
                        <tr>
                            <td scope="col" id="EditNewLocationHidden" type="hidden">Ny Lokation</td>
                            <td type="hidden" id="EditNewLocationInput"><input id="EditLocationInput" /></td>
                        </tr>
                    </form>
                    </thead>
                    <tbody id="Table">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuller</button>
                <button type="submit" id="EditConventionSubmit" form="EditConventionForm" class="btn btn-primary">Gem Ændringer</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DeleteConvention" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Slet Stævne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Er du sikker på du ville slette dette stævne?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nej</button>
                <button type="button" id="Yes" class="btn btn-primary">Ja</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DeleteLocations" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Slet Lokationer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Vælg lokationer.
                <div id="LocationsCheckboxes">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuller</button>
                <button type="submit" id="DeleteLocationsCheckboxes" class="btn btn-primary">Slet Lokationer</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="staevne/javascript/loadLocations.js"></script>
<script>
    function UpdatePicture(ele){
        let imgPath = ele.getAttribute('src');
        document.getElementById('modalPicture').setAttribute('src', imgPath);
    }
</script>
<script>
    $.ajax({
        url: 'staevne/php/loadConventions.php',
        success:function(data){
            var Conventions = JSON.parse(data);
            Conventions.forEach((Convention)=> { // TODO: FIX dry ass havin' lips
                var tr = document.createElement("tr");
                tr.id = JSON.parse(Convention).id;
                var td1 = tr.appendChild(document.createElement('td'));
                var td2 = tr.appendChild(document.createElement('td'));
                var td3 = tr.appendChild(document.createElement('td'));
                var td4 = tr.appendChild(document.createElement('td'));
                var td5 = tr.appendChild(document.createElement('td'));
                var td6 = tr.appendChild(document.createElement('td'));
                var td7 = tr.appendChild(document.createElement('td'));

                td1.innerHTML = JSON.parse(Convention).name;
                td1.id = "ConventionName" + JSON.parse(Convention).id;
                td2.innerHTML = JSON.parse(Convention).date;
                td2.id = "ConventionDate" + JSON.parse(Convention).id;
                td3.innerHTML = JSON.parse(Convention).start_time;
                td3.id = "ConventionStart" + JSON.parse(Convention).id;
                td4.innerHTML = JSON.parse(Convention).end_time;
                td4.id = "ConventionEnd" + JSON.parse(Convention).id;
                td5.innerHTML = JSON.parse(Convention).location;
                td5.id = "ConventionLocation" + JSON.parse(Convention).id;
                td6.innerHTML = "<img class='img-row-show' onclick='EditConvention(this)' src='../billeder/edit_icon.png' data-keyboard='false' data-backdrop='static' data-toggle='modal' data-target='#EditConvention'>";
                td7.innerHTML = "<img class='img-row-show' onclick='areYouSure(this)' src='../billeder/delete_icon.png' data-keyboard='false' data-backdrop='static' data-toggle='modal' data-target='#DeleteModal'>";

                document.getElementById("Table").appendChild(tr);
            });
        }
    });
</script>
<script>
    var Locations = document.getElementById("LocationSelect");
    $("#AddConventionForm").submit(function(e) {
        e.preventDefault();
        if(Locations.options[0].selected){
            var LocationInput = document.getElementById("LocationInput").value;
            if(LocationInput == "") {
                alert("Lokation kan ikke være tom");
            }else{
                $.ajax({
                    url: 'staevne/php/createLocation.php',
                    type: "POST",
                    data: {
                        Location: LocationInput
                    },
                    success:function(data){
                        if(data == 0){
                            alert("Lokation eksistere allerede");
                        }else {
                            LoadLocations("LocationSelect");
                            AddConvention(LocationInput);
                        }
                    }
                });
            }
        }else{
            AddConvention(LocationInput);
        }
    });
    $("#EditConventionForm").submit(function(e) {
        e.preventDefault();
        CheckNewLocation("EditLocationSelect", "EditNewLocationHidden", "EditNewLocationInput", "EditLocationInput");
        UpdateConventionLocation();
    });
    $(Locations).on('change', function () {
        CheckNewLocation("LocationSelect","NewLocationHidden", "NewLocationInput", "LocationInput");
    });
    $("#EditLocationSelect").on('change', function() {
        CheckNewLocation("EditLocationSelect", "EditNewLocationHidden", "EditNewLocationInput", "EditLocationInput");
    });

    function AddConvention(LocationInput) {
        var SelectedIndex = document.getElementById("LocationSelect").selectedIndex;
        var Location;
        if(LocationInput == null) {
            Location = document.getElementById("LocationSelect").options[SelectedIndex].id;
        }else{
            Location = LocationInput;
        }
        $.ajax({
            url: 'staevne/php/createConvention.php',
            type: "POST",
            data: {
                Name: document.getElementById("LocationName").value,
                Date: document.getElementById("LocationDate").value,
                Start: document.getElementById("LocationStart").value,
                End: document.getElementById("LocationEnd").value,
                Location: Location
            },
            success:function(){
                window.location.reload();
            }
        });
    }
</script>
<script>
function areYouSure(button) {
    $("#DeleteConvention").modal();
    document.getElementById('Yes').onclick = function() {
        deleteConvention(button);
    };
}
function deleteConvention(button){
    $.ajax({
        type: "POST",
        data: {id: button.parentElement.parentElement.id},
        url: 'staevne/php/deleteConventions.php',
        success:function() {
            location.reload();
        }
    });
}
</script>
<script>
    document.getElementById('DeleteLocationsButton').onclick = function() {
        LoadLocationsCheckboxes("LocationsCheckboxes");
    };
    document.getElementById('DeleteLocationsCheckboxes').onclick = function() {
        DeleteLocations();
    };
    document.getElementById('AddConventionButton').onclick = function() {
        ClearConventionModal();
    }
</script>
<script>
    function LoadLocationsCheckboxes(id) {
        $.ajax({
            url: 'staevne/php/loadLocations.php',
            success:function(data){
                var Locations = JSON.parse(data);
                var select =  document.getElementById(id);
                $(select).empty();
                Locations.forEach((Location) => {
                    var a = 0;
                    var div = document.createElement("div");
                    var a = document.createElement("a");
                    var checkbox = document.createElement('input');
                    a.innerHTML = " " + Location.location;
                    checkbox.type = "checkbox";
                    checkbox.id = "checkbox" + Location.id;
                    div.appendChild(checkbox);
                    div.appendChild(a);
                    select.appendChild(div);
                });
            }
        });
    }
    function DeleteLocations(){
        var DeleteList = [];
        $("#LocationsCheckboxes input[type=checkbox]").each(function() {
            var id;
            if(this.checked){
                id = this.id.slice(8);
                DeleteList.push(id);
            }
        });
        if (DeleteList != []){
            $.ajax({
                type: "POST",
                data: {Array : DeleteList},
                url: 'staevne/php/deleteLocations.php',
                success:function(){
                    $('#DeleteLocations').modal('hide');
                }
            });
        }
    }
</script>
<script>
    var Id;
    function EditConvention(button){
        LoadLocations("EditLocationSelect");
        Id = button.parentElement.parentElement.id;
        var Convention = document.getElementById(Id);
        var Name = document.getElementById("EditLocationName");
        var Date = document.getElementById("EditLocationDate");
        var Start = document.getElementById("EditLocationStart");
        var End = document.getElementById("EditLocationEnd");
        var Location = document.getElementById("EditLocationSelect");
        Name.value = document.getElementById("ConventionName" + Id).innerHTML;
        Date.value = document.getElementById("ConventionDate" + Id).innerHTML;
        Start.value = document.getElementById("ConventionStart" + Id).innerHTML;
        End.value = document.getElementById("ConventionEnd" + Id).innerHTML;
        for (var i = 0; i < Location.options.length; i++) {
            if (Location.options[i].innerHTML == document.getElementById("ConventionLocation" + Id).innerHTML) {
                Location.selectedIndex = i;
                Location.options[i].selected = true;
                break;
            }
        };
    }

    function CheckNewLocation(selectId, trId, inputId, Input) {
        var tr = document.getElementById(trId);
        var input = document.getElementById(inputId);
        var InputValue = document.getElementById(Input);
        var select = document.getElementById(selectId);
        if(select.options[0].selected){
            tr.hidden = false;
            input.hidden = false;
        }else{
            tr.hidden = true;
            input.hidden = true;
            InputValue.value = "";
        }
    }

    function ClearConventionModal() {
        var Name = document.getElementById("LocationName");
        var Date = document.getElementById("LocationDate");
        var Start = document.getElementById("LocationStart");
        var End = document.getElementById("LocationEnd");
        var Location = document.getElementById("LocationSelect");
        Name.value = "";
        Date.value = "";
        Start.value = "";
        End.value = "";
        Location.options.selectedIndex = 0;
        CheckNewLocation("LocationSelect","NewLocationHidden", "NewLocationInput", "LocationInput");
    }

    function UpdateConventionLocation() {
        var Locations = document.getElementById("EditLocationSelect");
        if(Locations.options[0].selected){
            var LocationInput = document.getElementById("EditLocationInput").value;
            if(LocationInput == "") {
                alert("Lokation kan ikke være tom");
            }else{
                $.ajax({
                    url: 'staevne/php/createLocation.php',
                    type: "POST",
                    data: {
                        Location: LocationInput
                    },
                    success:function(data){
                        if(data == 0){
                            alert("Lokation eksistere allerede");
                        }else {
                            LoadLocations("EditLocationSelect");
                            UpdateConvention();
                        }
                    }
                });
            }
        }else{
            UpdateConvention();
        }
    }

    function UpdateConvention() {
        var LocationInput = document.getElementById("EditLocationInput").value;
        var SelectedIndex = document.getElementById("EditLocationSelect").selectedIndex;
        var Location;
        if(LocationInput == "") {
            Location = document.getElementById("LocationSelect").options[SelectedIndex].id;
        }else{
            Location = LocationInput;
        }
        var Name = document.getElementById("EditLocationName").value;
        var Date = document.getElementById("EditLocationDate").value;
        var Start = document.getElementById("EditLocationStart").value;
        var End = document.getElementById("EditLocationEnd").value;
        $.ajax({
            type: "POST",
            data: {Id: Id, Name: Name, Date: Date, Start: Start, End: End, Location: Location},
            url: 'staevne/php/updateConvention.php',
            success:function() {
                window.location.reload();
            }
        });
    }
</script>
<script>
    LoadLocations("LocationSelect");
    LoadLocations("EditLocationSelect");
</script>
</body>
</html>