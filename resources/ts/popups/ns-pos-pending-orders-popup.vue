<template>
    <h1>Hello World</h1>
</template>
<script>
export default {
    mounted() {
        this.$popup.event.subscribe( action => {
            if ( action.event === 'click-overlay' ) {
                this.$popup.close();
            }
        });
    }
}
</script>