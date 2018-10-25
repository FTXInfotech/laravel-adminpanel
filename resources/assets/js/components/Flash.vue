<template>
    <div :class="typeClass" v-show="show" v-html="body">
        {{ body }}
    </div>
</template>

<script>
export default {
	props: ["message", "type", "dontHide"],

	data() {
		return {
			body: "",
			typeClass: "",
			show: false
		};
	},

	created() {
		const context = this;

		if (this.message && this.type) {
			this.flash(this.message, this.type, this.dontHide);
		}

		window.events.$on("flash", function(message, type) {
			context.flash(message, type);
		});
	},

	methods: {
		flash(message, type, dontHide = false) {

			if (! type) {
				type = "info";
			}

			this.body = message;
			this.typeClass = "alert alert-" + type;
			this.show = true;

			if(! dontHide) {
				this.hide();
			}
    	},

		hide() {
			setTimeout(() => {
				this.show = false;
			}, 3000);
		}
	}
};
</script>
