export default class Map {
	constructor($module, apiKey, cb = function() {}) {
		this.$module = $module;
		this.$map = $module.querySelector(".sb-map__map");
		this.$locationList = $module.querySelector(".sb-map__list");
		this.apiKey = apiKey;
		this.mapStyleIds = {
			light: "52763fe8da2feb10",
			dark: "658043d2c8977d9b"
		};
		this.markers = [];
		this.cb = cb;
		this.loadGoogleMaps();
	}
	loadGoogleMaps() {
		// Create the script tag, set the appropriate attributes
		var script = document.createElement("script");
		script.src = `https://maps.googleapis.com/maps/api/js?v=beta&key=${
			this.apiKey
		}&map_ids=${Object.values(this.mapStyleIds).join()}`;
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
			mapId: window.matchMedia("(prefers-color-scheme: dark)").matches
				? this.mapStyleIds.dark
				: this.mapStyleIds.light,
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
}
