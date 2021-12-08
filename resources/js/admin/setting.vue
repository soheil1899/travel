<template>
    <div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <h4 class="text-primary">
                    <i class="fas fa-chevron-circle-left"></i>
                    تنظیمات سایت</h4>
            </div>
            <div class="col-lg-6 text-left">
            </div>
        </div>


        <div class="row" v-if="setting">
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">عنوان سایت</label>
                <input type="text" class="form-control" v-model="setting.site_name">
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">عنوان متا</label>
                <input type="text" class="form-control" v-model="setting.title">
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">توضیحات متا</label>
                <input type="text" class="form-control" v-model="setting.description">
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">کلمات کلیدی متا</label>
                <input type="text" class="form-control" v-model="setting.keywords">
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">تلفن تماس</label>
                <input type="text" class="form-control" v-model="setting.tell">
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">شماره موبایل</label>
                <input type="text" class="form-control" v-model="setting.mobile">
            </div>
            <div class="col-md-6 mb-3">
                <label class="mb-2">آدرس</label>
                <input type="text" class="form-control" v-model="setting.address">
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">لینک تلگرام</label>
                <input type="text" class="form-control" v-model="setting.telegram">
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">لینک اینستاگرام</label>
                <input type="text" class="form-control" v-model="setting.instagram">
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">لینک لینکدین</label>
                <input type="text" class="form-control" v-model="setting.linkedin" >
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label class="mb-2">لینک آپارات</label>
                <input type="text" class="form-control" v-model="setting.aparat">
            </div>
            <div class="col-md-12 mb-3">
                <label class="mb-2">درباره سایت</label>
                <textarea class="form-control" rows="5" v-model="setting.about"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label class="mb-2">لوگو سایت</label>
                        <input type="file" class="form-control-file" ref="settingimage"
                               accept=".jpg, .png, .jpeg">
                        <img :src="'/logo.png?'+Math.floor(Math.random() * 100)" class="mt-3" width="100px" v-if="setting.site_logo" alt="">
                    </div>
                    <div class="col-md-6 pt-5 text-left">
                        <button class="btn mt-5 btn-primary px-5" @click="editSetting">ویرایش اطلاعات</button>
                    </div>
                </div>
            </div>
        </div>





    </div>
</template>

<script>
    import Swal from 'sweetalert2'

    export default {
        name: "setting",
        data(){
            return{
                setting: null,
            }
        },
        mounted() {
            this.getSetting();
        },
        methods:{
            getSetting() {
                axios.get('/admin/get-setting').then(res => {
                    this.setting = res.data;
                });
            },
            editSetting() {
                let fd = new FormData();
                fd.append('image', this.$refs.settingimage.files[0]);
                fd.append('setting', JSON.stringify(this.setting));
                axios.post('/admin/change-setting', fd, {'Content-Type': 'multipart/form-data'})
                    .then(res => {
                        this.getSetting();
                        Swal.fire({
                            icon: 'success',
                            text: 'تنظیمات با موفقیت ویرایش شد',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }).catch(res => {
                    Swal.fire({
                        icon: 'error',
                        text: res.response.data.msg,
                        showConfirmButton: false,
                        timer: 2000
                    })
                });
            },

        }
    }
</script>

<style scoped>

</style>
