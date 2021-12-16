<template>
    <div style="direction: rtl">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" @click="getCount">
                <a class="nav-link px-lg-4 active" id="home-tab" data-toggle="tab" href="#home">داشبورد</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-lg-4" id="user-tab" data-toggle="tab" href="#user">مدیریت کاربران</a>
            </li>
            <li class="nav-item" @click="getCategory">
                <a class="nav-link px-lg-4" id="category-tab" data-toggle="tab" href="#category" role="tab">مدیریت دسته بندی ها</a>
            </li>
            <li class="nav-item" @click="getCategory">
                <a class="nav-link px-lg-4" id="place-tab" data-toggle="tab" href="#place" role="tab">مدیریت مکان ها</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-lg-4" id="video-tab" data-toggle="tab" href="#video" role="tab">مدیریت ویدیوها</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-lg-4" id="comment-tab" data-toggle="tab" href="#comment" role="tab">مدیریت کامنت ها</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-lg-4" id="setting-tab" data-toggle="tab" href="#setting" role="tab">تنظیمات سایت</a>
            </li>
        </ul>
        <div class="tab-content text-right px-4 py-5" id="myTabContent">
            <div class="tab-pane fade show active" id="home">
                <div class="row justify-content-center mx-0">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد کل کاربران سایت</h5>
                            <h4 class="text-left">
                            <strong>{{counts['users']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد کل دسته بندی ها</h5>
                            <h4 class="text-left">
                            <strong>{{counts['category']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد کل مکان ها</h5>
                            <h4 class="text-left">
                            <strong>{{counts['place']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد کل ویدیوها</h5>
                            <h4 class="text-left">
                            <strong>{{counts['video']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد کل کامنت ها</h5>
                            <h4 class="text-left">
                            <strong>{{counts['comment_0'] + counts['comment_1']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد نظرات تایید نشده</h5>
                            <h4 class="text-left">
                            <strong>{{counts['comment_0']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد نظرات تایید شده</h5>
                            <h4 class="text-left">
                            <strong>{{counts['comment_1']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد کل بازدیدها</h5>
                            <h4 class="text-left">
                            <strong>{{counts['seen']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد کل پسندها</h5>
                            <h4 class="text-left">
                            <strong>{{counts['like_p'] + counts['like_c']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد پسندهای مکان</h5>
                            <h4 class="text-left">
                            <strong>{{counts['like_p']}}</strong>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="border bg-white p-3 rounded" style="box-shadow: 0 0 10px 0 #ccc">
                            <h5>تعداد پسندهای نظرات</h5>
                            <h4 class="text-left">
                            <strong>{{counts['like_c']}}</strong>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="user">
                <user-tab></user-tab>
            </div>
            <div class="tab-pane fade" id="category">
                <category-tab :categoryList="categoryList"></category-tab>
            </div>
            <div class="tab-pane fade" id="place">
                <place-tab :categoryList="categoryList"></place-tab>
            </div>
            <div class="tab-pane fade" id="video">
                <movie-tab></movie-tab>
            </div>
            <div class="tab-pane fade" id="comment">
                <comment-tab></comment-tab>
            </div>
            <div class="tab-pane fade" id="setting">
                <setting-tab></setting-tab>
            </div>
        </div>
    </div>
</template>

<script>
    import userTab from "./user";
    import categoryTab from "./category";
    import placeTab from "./place";
    import movieTab from "./movie";
    import commentTab from "./comment";
    import settingTab from "./setting";
    export default {
        name: "index",
        components:{userTab, categoryTab, placeTab, movieTab, commentTab, settingTab},
        data(){
            return{
                categoryList:[],
                counts: [],
            }
        },
        mounted() {
            this.getCategory();
            this.getCount();
        },
        methods:{
            getCategory(){
                axios.get('/admin/category-list').then(res => {
                    this.categoryList = res.data;
                });
            },
            getCount(){
                axios.get('/admin/get-count').then(res => {
                    this.counts = res.data;
                });
            }
        }
    }
</script>

<style scoped>

</style>
