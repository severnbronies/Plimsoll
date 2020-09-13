export default class Map {
	constructor($module, apiKey, cb = function() {}) {
		this.$module = $module;
		this.$map = $module.querySelector(".sb-map__map");
		this.$locationList = $module.querySelector(".sb-map__list");
		this.apiKey = apiKey;
		this.markers = [];
		this.cb = cb;
		this.loadGoogleMaps();
	}
	loadGoogleMaps() {
		// Create the script tag, set the appropriate attributes
		var script = document.createElement("script");
		script.src = `https://maps.googleapis.com/maps/api/js?key=${this.apiKey}`;
		script.defer = true;
		script.async = true;
		script.onload = () => {
			this.initGoogleMaps();
		};
		document.head.appendChild(script);
	}
	initGoogleMaps() {
		this.map = new google.maps.Map(this.$map, {
			center: { lat: 0, lng: 0 },
			zoom: 0,
			gestureHandling: "cooperative",
			styles: this.mapStyle(),
			disableDefaultUI: true
		});
		this.map.addListener("idle", () => {
			if (this.map.getZoom() > 16) {
				this.map.setZoom(16);
			}
		});
		this.mapBoundary = new google.maps.LatLngBounds();
		// Custom marker icon set up
		this.markerStyle = {
			url:
				"https://severnbronies.co.uk/wp-content/themes/plimsoll/dist/images/google-map-pin.png",
			size: new google.maps.Size(28, 35),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(14, 35),
			labelOrigin: new google.maps.Point(14, 15)
		};
		this.markerLabelStyle = text => {
			return {
				color: "#fff",
				fontFamily: "Montserrat, sans-serif",
				fontWeight: "900",
				fontSize: "16px",
				text: text
			};
		};
		// Now run everything we're passing from the page
		this.cb();
	}
	addMultipleLocations(locations) {
		locations.forEach(loc => {
			this.addLocation(loc);
		});
	}
	addLocation(location) {
		const latLng = {
			lat: +location.latitude,
			lng: +location.longitude
		};
		const markerIndex = this.markers.length;
		let marker = new google.maps.Marker({
			map: this.map,
			title: location.name,
			position: latLng,
			icon: this.markerStyle,
			label: this.markerLabelStyle((markerIndex + 1).toString())
		});
		marker.addListener("mouseover", () => {
			this.$locationList
				.getElementsByTagName("li")
				[markerIndex].classList.add("sb-map__list-item--highlight");
		});
		marker.addListener("mouseout", () => {
			this.$locationList
				.getElementsByTagName("li")
				[markerIndex].classList.remove("sb-map__list-item--highlight");
		});
		this.markers.push(marker);
		this.mapBoundary.extend(latLng);
		this.repaintMapBounds();
	}
	repaintMapBounds() {
		this.map.fitBounds(this.mapBoundary);
		this.map.setCenter(this.mapBoundary.getCenter());
	}
	mapStyle() {
		if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
			return [
				{ elementType: "geometry", stylers: [{ color: "#212121" }] },
				{ elementType: "labels.icon", stylers: [{ visibility: "off" }] },
				{ elementType: "labels.text.fill", stylers: [{ color: "#757575" }] },
				{ elementType: "labels.text.stroke", stylers: [{ color: "#212121" }] },
				{
					featureType: "administrative",
					elementType: "geometry",
					stylers: [{ color: "#757575" }]
				},
				{
					featureType: "administrative.country",
					elementType: "labels.text.fill",
					stylers: [{ color: "#9e9e9e" }]
				},
				{
					featureType: "administrative.land_parcel",
					stylers: [{ visibility: "off" }]
				},
				{
					featureType: "administrative.locality",
					elementType: "labels.text.fill",
					stylers: [{ color: "#bdbdbd" }]
				},
				{
					featureType: "poi",
					elementType: "labels.text.fill",
					stylers: [{ color: "#757575" }]
				},
				{
					featureType: "poi.park",
					elementType: "geometry",
					stylers: [{ color: "#181818" }]
				},
				{
					featureType: "poi.park",
					elementType: "labels.text.fill",
					stylers: [{ color: "#616161" }]
				},
				{
					featureType: "poi.park",
					elementType: "labels.text.stroke",
					stylers: [{ color: "#1b1b1b" }]
				},
				{
					featureType: "road",
					elementType: "geometry.fill",
					stylers: [{ color: "#2c2c2c" }]
				},
				{
					featureType: "road",
					elementType: "labels.text.fill",
					stylers: [{ color: "#8a8a8a" }]
				},
				{
					featureType: "road.arterial",
					elementType: "geometry",
					stylers: [{ color: "#373737" }]
				},
				{
					featureType: "road.highway",
					elementType: "geometry",
					stylers: [{ color: "#3c3c3c" }]
				},
				{
					featureType: "road.highway.controlled_access",
					elementType: "geometry",
					stylers: [{ color: "#4e4e4e" }]
				},
				{
					featureType: "road.local",
					elementType: "labels.text.fill",
					stylers: [{ color: "#616161" }]
				},
				{
					featureType: "transit",
					elementType: "labels.text.fill",
					stylers: [{ color: "#757575" }]
				},
				{
					featureType: "water",
					elementType: "geometry",
					stylers: [{ color: "#000000" }]
				},
				{
					featureType: "water",
					elementType: "labels.text.fill",
					stylers: [{ color: "#3d3d3d" }]
				}
			];
		}
		return [
			{ elementType: "geometry", stylers: [{ color: "#f5f5f5" }] },
			{ elementType: "labels.icon", stylers: [{ visibility: "off" }] },
			{ elementType: "labels.text.fill", stylers: [{ color: "#616161" }] },
			{ elementType: "labels.text.stroke", stylers: [{ color: "#f5f5f5" }] },
			{
				featureType: "administrative.land_parcel",
				elementType: "labels.text.fill",
				stylers: [{ color: "#bdbdbd" }]
			},
			{
				featureType: "poi",
				elementType: "geometry",
				stylers: [{ color: "#eeeeee" }]
			},
			{
				featureType: "poi",
				elementType: "labels.text.fill",
				stylers: [{ color: "#757575" }]
			},
			{
				featureType: "poi.park",
				elementType: "geometry",
				stylers: [{ color: "#e5e5e5" }]
			},
			{
				featureType: "poi.park",
				elementType: "labels.text.fill",
				stylers: [{ color: "#9e9e9e" }]
			},
			{
				featureType: "road",
				elementType: "geometry",
				stylers: [{ color: "#ffffff" }]
			},
			{
				featureType: "road.arterial",
				elementType: "labels.text.fill",
				stylers: [{ color: "#757575" }]
			},
			{
				featureType: "road.highway",
				elementType: "geometry",
				stylers: [{ color: "#dadada" }]
			},
			{
				featureType: "road.highway",
				elementType: "labels.text.fill",
				stylers: [{ color: "#616161" }]
			},
			{
				featureType: "road.local",
				elementType: "labels.text.fill",
				stylers: [{ color: "#9e9e9e" }]
			},
			{
				featureType: "transit.line",
				elementType: "geometry",
				stylers: [{ color: "#e5e5e5" }]
			},
			{
				featureType: "transit.station",
				elementType: "geometry",
				stylers: [{ color: "#eeeeee" }]
			},
			{
				featureType: "water",
				elementType: "geometry",
				stylers: [{ color: "#c9c9c9" }]
			},
			{
				featureType: "water",
				elementType: "labels.text.fill",
				stylers: [{ color: "#9e9e9e" }]
			}
		];
	}
}
