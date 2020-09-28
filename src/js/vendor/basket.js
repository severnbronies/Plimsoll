(function() {
	if (location.hostname !== "localhost") {
		setTimeout(() => {
			console.log(
				document.querySelector('script[type="purple/smart"]').innerText
			);
		}, 100);
	}
})();
