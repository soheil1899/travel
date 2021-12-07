<template>
    <div style="direction: rtl">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link px-lg-4" id="home-tab" data-toggle="tab" href="#home">داشبورد</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-lg-4" id="user-tab" data-toggle="tab" href="#user">مدیریت کاربران</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-lg-4 active" id="category-tab" data-toggle="tab" href="#category" role="tab">مدیریت دسته بندی ها</a>
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
            <div class="tab-pane fade" id="home">...</div>
            <div class="tab-pane fade" id="user">
                <user-index></user-index>
            </div>
            <div class="tab-pane fade show active" id="category">
                <category-index></category-index>
            </div>
            <div class="tab-pane fade" id="place">...</div>
            <div class="tab-pane fade" id="video">...</div>
            <div class="tab-pane fade" id="comment">...</div>
            <div class="tab-pane fade" id="setting">...</div>
        </div>
    </div>
</template>

<script>
    import userIndex from "./userIndex";
    import categoryIndex from "./categoryIndex";
    export default {
        name: "index",
        components:{userIndex, categoryIndex},
    }
</script>

<style scoped>

</style>
