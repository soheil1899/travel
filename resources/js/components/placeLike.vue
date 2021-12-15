<template>
    <div class="d-inline-block">
        <button class="btn btn-light border" @click="likePlace">
            <i class="fas fa-heart"></i>
            {{like}}
        </button>
    </div>
</template>

<script>
    export default {
        name: "placeLike",
        props: ['place_id', 'like'],
        methods:{
            likePlace(){
                axios.get('/place-like/'+this.place_id).then(res => {
                    if (res.data==='ADD') this.like++;
                });
            }
        }
    }
</script>

<style scoped>

</style>
