<template>

    <iframe width="100%" height="450px" v-bind:src=this.parsePlayer frameborder="0" allowfullscreen></iframe>

</template>

<script>
    export default {
        props:['url_stream', 'stream_id'],
        data() {
            return {
                url:'http://',
                status:false,
                parsePlayer: ''
            }
        },
        created() {

            this.parsePlayer  = "//" + this.url_stream + ":/LiveApp/play.html?name=" + this.stream_id + "&autoplay=true";

            this.url = this.url + this.url_stream + "/LiveApp/rest/broadcast/get?id=" + this.stream_id+"&autoplay";

            this.isLiveStream();
        },
        methods: {
            isLiveStream(){
                /*axios.get(this.url).then(response => {
                    console.log(response)
                    //this.status = response;
                })*/
            }
        }
    }
</script>
