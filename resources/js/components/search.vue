<template>
    <div class="row">
        <div class="col-lg-6">
            <input type="text" class="form-control" v-model="word" placeholder="کلمه مورد نظر خود را بنویسید">
        </div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-success px-5" @click="search">جستجو کن</button>
        </div>

        <div class="col-12 mt-5" v-if="places.length>0">
            <a v-for="p in places" :href="'/place/'+p['id']+'/'+p['title']" class="row border rounded mx-0 mb-3 p-3">
                <div class="col-lg-4 pr-0">
                    <div class="page2-img" :style="'background-image: url(/place/'+p['id']+'/'+p['image']+')'"></div>
                </div>
                <div class="col-lg-8 py-2 pl-0">
                    <h2 class="text-primary font16">{{p['title']}}</h2>
                    <p><i class="fas fa-map-marker-alt text-primary font16"></i>
                        {{p['address']}}</p>
                    <p class="mb-0">
                        {{p['description']}}
                    </p>
                </div>
            </a>
        </div>
        <div class="col-12 mt-5" v-else-if="search_flag">
            <div class="alert alert-danger w-100" role="alert">
            متاسفانه مکان و رستورانی با فیلتر وارد شده یافت نشد.
            </div>
        </div>

        <div class="col-12 mt-5" v-if="videos.length>0">
            <div class="row">
                <div class="col-md-4 mb-3" v-for="v in videos">
                    <div class="p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc;">
                        <a :href="'/video/'+v['id']+'/'+v['title']" class="col-lg-3 col-md-6">
                            <div class="index-img pointer position-relative" :style="'background-image: url(/movie/'+v['image']+')'">
                                <i class="fas fa-play-circle position-absolute text-white text-center" style="font-size:50px;left: 0; right: 0; top: 35%"></i>
                            </div>
                            <h6 class="mt-3">{{v['title']}}</h6>
                            <label class="font11" style="color:#ccc">{{v.created_at|date('jD jMMMM jYYYY')}}</label>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5" v-else-if="search_flag">
            <div class="alert alert-danger w-100" role="alert">
                متاسفانه ویدیویی با فیلتر وارد شده یافت نشد.
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "search",
        data(){
            return{
                word: '',
                places: [],
                videos: [],
                search_flag: false,
            }
        },
        methods:{
            search(){
                axios.post('/searching', {word:this.word}).then(res => {
                    this.places = res.data.places;
                    this.videos = res.data.videos;
                    this.search_flag = true;
                });
            }
        }
    }
</script>

<style scoped>

</style>
