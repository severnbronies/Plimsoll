export default class Map {
	constructor($module, cb = function() {}) {
		this.$module = $module;
		this.apiKey = "AIzaSyCmQJYucuxqKFwJoWiDTOwvFRGrTNXX9zk";
		this.markers = [];
		this.cb = cb;
		this.loadGoogleMaps();
	}
	loadGoogleMaps() {
		// Create the script tag, set the appropriate attributes
		var script = document.createElement("script");
		script.src =
			"https://maps.googleapis.com/maps/api/js?key=AIzaSyCmQJYucuxqKFwJoWiDTOwvFRGrTNXX9zk";
		script.defer = true;
		script.async = true;
		script.onload = () => {
			this.initGoogleMaps();
		};
		document.head.appendChild(script);
	}
	initGoogleMaps() {
		this.map = new google.maps.Map(this.$module, {
			center: { lat: 0, lng: 0 },
			zoom: 0,
			gestureHandling: "cooperative"
		});
		this.map.addListener("idle", () => {
			if (this.map.getZoom() > 16) {
				this.map.setZoom(16);
			}
		});
		this.mapBoundary = new google.maps.LatLngBounds();
		this.cb();
	}
	addLocation(location) {
		const latLng = { lat: location.lat, lng: location.lng };
		let infoWindow = new google.maps.InfoWindow({
			content: `<strong>${location.name}</strong><br>${location.address}`
		});
		let marker = new google.maps.Marker({
			map: this.map,
			title: location.name,
			label: (this.markers.length + 1).toString(),
			position: latLng
		});
		marker.addListener("click", () => {
			infoWindow.open(this.map, marker);
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
