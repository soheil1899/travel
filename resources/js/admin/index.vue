<template>
    <div style="direction: rtl">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link px-lg-4 active" id="home-tab" data-toggle="tab" href="#home">داشبورد</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-lg-4" id="user-tab" data-toggle="tab" href="#user">مدیریت کاربران</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-lg-4" id="category-tab" data-toggle="tab" href="#category" role="tab">مدیریت دسته بندی ها</a>
            </li>
            <li class="nav-item">
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
            <div class="tab-pane fade show active" id="home">...</div>
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
            }
        },
        mounted() {
            axios.get('/admin/category-list').then(res => {
                this.categoryList = res.data;
            });
        }
    }
</script>

<style scoped>

</style>
