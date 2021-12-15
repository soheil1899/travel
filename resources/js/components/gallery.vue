<template>
    <div class="position-absolute" v-if="images.length>0" style="right: 50px; top: 0; direction: ltr">
        <div>
            <i @click="onClick(0)" class="far fa-images pointer font22 text-secondary"></i>
        </div>
        <vue-gallery-slideshow :images="images" :index="index" @close="index = null"></vue-gallery-slideshow>
    </div>
</template>

<script>
    import VueGallerySlideshow from 'vue-gallery-slideshow'

    export default {
        name: "gallery",
        components: {
            VueGallerySlideshow
        },
        props:['place_id'],
        data() {
            return{
                images: [],
                index: null
            }
        },
        mounted() {
            axios.get('/place-gallery/'+this.place_id).then(res => {
                let images = res.data;
                for(var i=0; i<images.length; i++)
                    this.images.push('/place/'+this.place_id+'/'+images[i])
            });
        },
        methods: {
            onClick(i) {
                this.index = i;
            }
        },
    }
</script>

<style scoped>

</style>
