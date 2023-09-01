export let viewport = {

	windowWidth : null,
	windowHeight : null,

    // calculate and store viewport dimensions
    // this method will be bound to window resize event so try not to overload it
	init : function() {

		this.windowWidth = window.innerWidth;
		this.windowHeight = window.innerHeight;

	},

}