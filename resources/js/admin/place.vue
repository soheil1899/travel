<template>
    <div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <h4 class="text-primary">
                    <i class="fas fa-chevron-circle-left"></i>
                    مدیریت مکان ها</h4>
            </div>
            <div class="col-lg-6 text-left">
                <button class="btn btn-sm btn-success px-4" @click="addPlace">افزودن مکان جدید</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">عنوان مکان</th>
                <th class="text-center" scope="col">دسته بندی</th>
                <th class="text-center" scope="col">نوع مکان</th>
                <th class="text-center" scope="col">آدرس</th>
                <th class="text-center" scope="col">بازدید</th>
                <th class="text-center" scope="col">پسند</th>
                <th class="text-center" scope="col">نظر</th>
                <th class="text-center" scope="col">تاریخ ایجاد</th>
                <th class="text-center" scope="col" width="20%">
                    <i class="fas fa-cogs fa-lg"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="c in list">
                <th class="text-center" scope="row">{{c.id}}</th>
                <td class="text-center">{{c.title}}</td>
                <td class="text-center">{{c.category.title}}</td>
                <td class="text-center">{{c.type}}</td>
                <td class="text-center">{{c.address}}</td>
                <td class="text-center">{{c.seen}}</td>
                <td class="text-center">{{c.like}}</td>
                <td class="text-center">{{c.comments}}</td>
                <td class="text-center">{{c.created_at|date('jYYYY/jM/jD  -  HH:mm')}}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-cyan" @click="getGallery(c)">تصاویر</button>
                    <button class="btn btn-sm btn-purple" @click="editDescriptionPlace(c)">توضیحات</button>
                    <button class="btn btn-sm btn-primary" @click="editPlace(c)">ویرایش</button>
                    <button class="btn btn-sm btn-dark" @click="deletePlace(c.id)">حذف</button>
                </td>
            </tr>
            </tbody>
        </table>

        <nav aria-label="Page navigation example" class="d-block text-center mb-4 mt-5" v-if="lastpage > 1">
            <ul class="pagination d-inline-block" style="direction: rtl">
                <li class="page-item pointer d-inline-block" :class="page===1? 'disabled': ''"  style="margin-right: -3px"><a class="page-link" @click="changePage('prev')"><i
                    class="fas fa-arrow-right"></i></a></li>
                <li class="page-item pointer d-inline-block ml-1" :class="page===p? 'active': ''" v-for="p in lastpage"><a class="page-link" @click="page = p">{{p}}</a></li>
                <li class="page-item pointer d-inline-block" :class="page===lastpage? 'disabled': ''"><a class="page-link" @click="changePage('next')"><i
                    class="fas fa-arrow-left"></i></a></li>
            </ul>
        </nav>




        <!-- Add Edit Modal -->
        <div class="modal fade" id="placeModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="mb-0 mt-2">{{modalTitle}}</h4>
                        <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">عنوان مکان <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="place.title">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">دسته بندی <span class="text-danger">*</span></label>
                                <select class="form-control" v-model="place.category_id">
                                    <option v-for="c in categoryList" :value="c.id">{{c.title}}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">شعار</label>
                                <input type="text" class="form-control" v-model="place.flag">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">نوع مکان</label>
                                <select class="form-control" v-model="place.type">
                                    <option>جاذبه طبیعت</option>
                                    <option>مکان قدیمی</option>
                                    <option>مکان مدرن</option>
                                    <option>رستوران</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">آدرس</label>
                                <input type="text" class="form-control" v-model="place.address">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">تگ ها (جداسازی با /)</label>
                                <input type="text" class="form-control" v-model="place.tags">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">طول جغرافیایی</label>
                                <input type="text" class="form-control" v-model="place.lat">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">عرض جغرافیایی</label>
                                <input type="text" class="form-control" v-model="place.lng">
                            </div>




                            <div class="col-md-12 mb-3 pt-4 text-left">
                                <button class="btn  btn-block btn-primary px-5" @click="savePlace">ذخیره مکان</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Add Edit Modal -->
        <div class="modal fade" id="placeDescriptionModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="mb-0 mt-2">توضیحات مربوط به مکان {{place.title}}</h4>
                        <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <editor v-model="place.content"
                                        api-key="3wu93q3r5cqr4wjv1f2bfqnb9ipogb37lvl7chpsuyubd4kk"
                                        :init="{
         height: 500,
         menubar: false,
         plugins: [
           'advlist autolink lists link image charmap print preview anchor',
           'searchreplace visualblocks code fullscreen',
           'insertdatetime media table paste code help wordcount directionality'
         ],
         toolbar:
           'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | help | ltr rtl | link | preview | \
           table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | \
            tableinsertcolbefore tableinsertcolafter tabledeletecol'
       }"
                                />

                            </div>
                            <div class="col-md-12 mb-3 pt-4 text-left">
                                <button class="btn  btn-block btn-primary px-5" @click="savePlace">ذخیره توضیحات مکان</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Add Edit Modal -->
        <div class="modal fade" id="placeGalleryModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="mb-0 mt-2">تصاویر مربوط به مکان {{place.title}}</h4>
                        <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div v-for="(g, i) in gallery" class="m-3 float-right position-relative">
                                    <img :src="'/place/'+ place_id + '/small/'+ g.address" height="100">
                                    <i class="fas fa-times-circle position-absolute delete-filemanager pointer" @click="deleteGallery(g, i)"></i>
                                </div>

                                <input type="file" class="d-none" id="browse" ref="image"
                                       @change="selectimage" accept=".jpg, .png, .jpeg">
                            </div>
                            <div class="col-md-12 mb-3 pt-4 text-left">
                                <button class="btn btn-block btn-primary px-5" @click="browsefile">افزودن تصویر جدید</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</template>

<script>
    import Editor from '@tinymce/tinymce-vue'

    import Swal from 'sweetalert2'

    export default {
        name: "place",
        data(){
            return{
                list: [],
                gallery: [],
                place_id:null,
                page:1,
                total:0,
                lastpage:0,
                modalTitle: 'افزودن مکان جدید',
                place:{
                    id: null,
                    category_id: null,
                    title: '',
                    flag: '',
                    type: 'جاذبه طبیعت',
                    tags: '',
                    address: '',
                    lat: '',
                    lng: '',
                    content: '',
                },
                contentTitle: '',
            }
        },
        props:['categoryList'],
        watch: {
            page: function () {
                this.getPlaceList();
            },
        },
        mounted() {
            this.getPlaceList();
        },
        components: {
            'editor': Editor
        },
        methods:{
            browsefile() {
                document.getElementById("browse").click();
            },
            selectimage() {
                let fd = new FormData();
                fd.append('image', this.$refs.image.files[0]);
                fd.append('place_id', this.place_id);
                axios.post('/admin/save-place-gallery', fd, {'Content-Type': 'multipart/form-data'})
                    .then(res=>{
                        this.gallery.push(res.data);
                    });
            },
            getGallery(place){
                this.place_id = place.id;
                this.place.title = place.title;
                axios.get("/admin/place-gallery/"+place.id).then(res => {
                    this.gallery = res.data;
                    $('#placeGalleryModal').modal('show')
                });
            },
            deleteGallery(file, index) {
                axios.post('/admin/delete-gallery', {file: file})
                    .then(res => {
                        this.gallery.splice(index, 1);
                    });
            },
            addPlace(){
                this.place.id= null;
                this.place.category_id= null;
                this.place.title= '';
                this.place.flag= '';
                this.place.type= 'جاذبه طبیعت';
                this.place.tags= '';
                this.place.address= '';
                this.place.lat= '';
                this.place.lng= '';
                this.place.content = '';
                this.modalTitle= 'افزودن مکان جدید';
                $('#placeModal').modal('show')
            },
            editPlace(place){
                this.place.id= place.id;
                this.place.category_id= place.category_id;
                this.place.title= place.title;
                this.place.flag= place.flag;
                this.place.type= place.type;
                this.place.tags= place.tags;
                this.place.address= place.address;
                this.place.lat= place.lat;
                this.place.lng= place.lng;
                if (place.content)
                    this.place.content= place.content;
                else
                    this.place.content = '';
                this.modalTitle= 'ویرایش مکان';
                $('#placeModal').modal('show')
            },
            editDescriptionPlace(place){
                if (place.content)
                    this.place.content= place.content;
                else
                    this.place.content = '';

                this.place.id= place.id;
                this.place.category_id= place.category_id;
                this.place.title= place.title;
                this.place.flag= place.flag;
                this.place.type= place.type;
                this.place.tags= place.tags;
                this.place.address= place.address;
                this.place.lat= place.lat;
                this.place.lng= place.lng;
                $('#placeDescriptionModal').modal('show')
            },
            getPlaceList() {
                axios.get('/admin/place-list?page=' + this.page).then(res => {
                    this.list = res.data.data;
                    this.total = res.total;
                    this.lastpage = res.data.last_page;
                });
            },

            savePlace() {
                if(this.place.title === '' && this.place.category_id===null)
                    Swal.fire({
                        icon: 'error',
                        text: 'لطفا مقادیر ضروری را وارد کنید',
                        showConfirmButton: false,
                        timer: 1500
                    })
                else {
                    axios.post('/admin/save-place', {place: this.place})
                        .then(res => {
                            this.getPlaceList();
                            Swal.fire({
                                icon: 'success',
                                text: 'مکان مورد نظر با موفقیت ذخیره شد',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#placeModal').modal('hide')
                        }).catch(res => {
                        Swal.fire({
                            icon: 'error',
                            text: res.response.data.msg,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    });
                }
            },
            deletePlace(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: 'btn btn-danger mx-3 px-5',
                        confirmButton: 'btn btn-success mx-3 px-5'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    text: 'آیا نسبت به پاک کردن این مکان اطمینان دارید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'خیر',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete("/admin/delete-place/"+id).then(res => {
                            Swal.fire({
                                icon: 'success',
                                text: 'مکان مورد نظر با موفقیت پاک شد',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.getPlaceList();
                        });
                    }
                })
            }
        }
    }
</script>


<style scoped>

</style>
