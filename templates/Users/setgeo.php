<div id="mapid"></div>

<div class="row">
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Setear ubicación del recurso humano <small> - Clickear en el mapa la ubicación que se desee asignar</small>') ?></legend>
                <?php
					echo $this->Form->control('map_lat', ['label' => 'Latitud']);
					echo $this->Form->control('map_long', ['label' => 'Longitud']);
				?>
            </fieldset>
			<?= $this->Form->button(__('Guardar')) ?>
			<?= $this->Form->end() ?>
        </div>
    </div>
</div>

<style>
    .col-popup{
        text-align: center;
        font-size:13px;
    }
    .col-popup span{
        font-size: 18px;
        font-weight: 700;
    }
    .col-popup.col-popup--ok span{
        color: #6BB26C;
    }
    .col-popup.col-popup--warn span{
        color: #F27A38;
    }
    .col-popup.col-popup--danger span{
        color: #F92419;
    }
    .im{    
        color: #fff;
        display: flex;
        padding: 10px;
        font-size: 15px;
        justify-content: space-around;
        flex-direction: column;
    }
    .ima{
        background-color:#f15f21;
    }
    .imb{
        background-color:#ccb700;
    }
    .imab{
        background-color:#3c9f40;
    }
    .noim{
        background-color:#f44336;
    }
    p.popup-pacient__name {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
    }
    p.popup-pacient__item {
        margin: 0 0 4px;
    }
    p.popup-pacient__item span{
        font-weight: 700;
    }

    .popup-pacient__list {
        font-size: 16px;
    }
</style>

<script>
    <?php 
        switch ($user->profile_id) {
            case 4:
                echo "var markerType = \"".$this->Url->build("/", ['fullBase' => true])."img/marker-cuf.png\";\n";
                break;
            case 5:
                echo "var markerType = \"".$this->Url->build("/", ['fullBase' => true])."img/marker-rn.png\";\n";
                break;
            case 6:
                echo "var markerType = \"".$this->Url->build("/", ['fullBase' => true])."img/marker-ot.png\";\n";
                break;
            case 7:
                echo "var markerType = \"".$this->Url->build("/", ['fullBase' => true])."img/marker-as.png\";\n";
                break;
            default:
                echo "var markerType = \"".$this->Url->build("/", ['fullBase' => true])."img/marker-ok.png\";\n";
                break;
        }
    ?>
	mapboxgl.accessToken = 'pk.eyJ1IjoibWRlYW5xdWluMjAyMyIsImEiOiJjbGdncXF5engwM3FxM2ZvZHVhMG9nMzN5In0.f49ef6XOSIs_YlwXWY4KCQ';
	const mymap = new mapboxgl.Map({
		container: 'mapid',
		// Choose from Mapbox's core styles, or make your own style with Mapbox Studio
		style: 'mapbox://styles/mapbox/streets-v12',
		center: [-64.2037528, -31.4196724],
		zoom: 10
	});

	var el = document.createElement("div");
	el.className = 'marker';
	el.style.backgroundImage = `url(${markerType})`;
	el.style.width = `50px`;
	el.style.height = `73.6px`;
	el.style.backgroundSize = '100%';
    var geoMarker = undefined;

    <?php if($user->map_lat && $user->map_long){ ?>
		geoMarker = new mapboxgl.Marker(el)
		.setLngLat([<?= $user->map_long ?>,<?= $user->map_lat ?>])
		.addTo(mymap);
    <?php } ?>

    mymap.on("click", function (event) {
		if (event.originalEvent.target.classList.contains('mapboxgl-marker')) return;
		geoMarker = new mapboxgl.Marker(el)
		.setLngLat(event.lngLat)
		.addTo(mymap);
		$('#map-lat').val(event.lngLat.lat);
		$('#map-long').val(event.lngLat.lng);
    });

    $.ajax({
		type: "GET",
		url: '<?= $this->Url->build(['controller'=>'Pacients', 'action' => 'getPacientsMarkers']) ?>',
		success: function (data) {
			parsedData = JSON.parse(data);
			if(parsedData){
				for(const marker of parsedData.features) {
					var icon = marker.properties.icon;
					var element = document.createElement("div");
					element.className = 'marker';
					element.style.backgroundImage = `url(${icon})`;
					element.style.width = `50px`;
					element.style.height = `73.6px`;
					element.style.backgroundSize = '100%';

					const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
						getMarkupFromPacient(marker.properties)
					);

					new mapboxgl.Marker(element)
					.setLngLat(marker.geometry.coordinates)
					.setPopup(popup)
					.addTo(mymap);
				}
			}
		}
	});

    function getMarkupFromPacient(pacient) {
        var output = '';
        output += '<h3>'+pacient.name+'</h3>';
        output += '<p>'+pacient.address+'</p>';
        output += '<p style="margin-bottom:2px;font-weight:700">Inmunización:</p>';
        output += '<div class="im '+pacient.im_status+'">Gripe:'+pacient.inmunity_a+'<br/>Neumococo:'+pacient.inmunity_b+'</div>';
        return output;
    }

    //marker.bindPopup("<b>Hello world!</b><br>I am a popup.");
</script>