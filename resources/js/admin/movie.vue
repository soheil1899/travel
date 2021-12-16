<template>
    <div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <h4 class="text-primary">
                    <i class="fas fa-chevron-circle-left"></i>
                    مدیریت ویدیو</h4>
            </div>
            <div class="col-lg-6 text-left">
                <button class="btn btn-sm btn-success px-4" @click="addMovie">افزودن ویدیو جدید</button>
            </div>
        </div>


        <div class="row" v-if="list">
            <div class="col-lg-4 mb-5" v-for="m in list">
                <div :id="m.id"><script type="text/JavaScript" :src="'https://www.aparat.com/embed/'+m.aparat_link+'?data[rnddiv]='+m.id+'&data[responsive]=yes'"></script></div>

                <div class="mt-3">
                    <h6>{{m.title}}</h6>
                    <div>
                        <button class="btn btn-sm btn-purple" @click="editDescriptionMovie(m)">توضیحات</button>
                        <button class="btn btn-sm btn-orange" v-if="m.image" @click="showImage(m)">مشاهده تصویر</button>
                        <button class="btn btn-sm btn-cyan" v-if="m.image" @click="imageMovie(m.id)">ویرایش تصویر</button>
                        <button class="btn btn-sm btn-cyan" v-else @click="imageMovie(m.id)">افزودن تصویر</button>
                        <button class="btn btn-sm btn-primary" @click="editMovie(m)">ویرایش</button>
                        <button class="btn btn-sm btn-dark" @click="deleteMovie(m.id)">حذف</button>
                    </div>
                </div>
            </div>
            <input type="file" class="d-none" id="browseMovie" ref="movieimage"
                   @change="selectImageMovie" accept=".jpg, .png, .jpeg">
        </div>



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
        <div class="modal fade" id="movieModal" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel" aria-hidden="true">
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
                                <label class="mb-0">عنوان ویدیو <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="movie.title">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">لینک آپارات <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="movie.aparat_link">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">تگ ها (جداسازی با /)</label>
                                <input type="text" class="form-control" v-model="movie.tags">
                            </div>

                            <div class="col-md-12 mb-3 pt-4 text-left">
                                <button class="btn  btn-block btn-primary px-5" @click="saveMovie">ذخیره ویدیو</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Add Edit Modal -->
        <div class="modal fade" id="showImageModal" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="mb-0 mt-2">نمایش تصویر</h4>
                        <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img :src="'/movie/'+image" style="max-width: 100%" alt="">
                    </div>
                </div>
            </div>
        </div>




        <!-- Add Edit Modal -->
        <div class="modal fade" id="movieDescriptionModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="mb-0 mt-2">توضیحات مربوط به ویدیو {{movie.title}}</h4>
                        <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <editor v-model="movie.content"
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
                                <button class="btn  btn-block btn-primary px-5" @click="saveMovie">ذخیره توضیحات ویدیو</button>
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
        name: "movie",
        data(){
            return{
                list: [],
                page: 1,
                total: 0,
                lastpage: 0,
                modalTitle: 'افزودن ویدیو جدید',
                movie:{
                    id: null,
                    title: '',
                    aparat_link: '',
                    tags: '',
                    image: null,
                    content: '',
                },
                image: null,
                movie_id: null,
            }
        },
        watch: {
            page: function () {
                this.getMovieList();
            },
        },
        components: {
            'editor': Editor
        },
        mounted() {
            this.getMovieList();
        },
        methods:{
            editDescriptionMovie(movie){
                if (movie.content)
                    this.movie.content= movie.content;
                else
                    this.movie.content = '';

                this.movie.id= movie.id;
                this.movie.title= movie.title;
                this.movie.aparat_link= movie.aparat_link;
                this.movie.tags= movie.tags;
                $('#movieDescriptionModal').modal('show')
            },
            imageMovie(id) {
                this.movie_id = id;
                document.getElementById("browseMovie").click();
            },
            selectImageMovie() {
                let fd = new FormData();
                fd.append('image', this.$refs.movieimage.files[0]);
                fd.append('movie_id', this.movie_id);
                axios.post('/admin/save-movie-image', fd, {'Content-Type': 'multipart/form-data'})
                    .then(res=>{
                        this.getMovieList();
                    });
            },
            showImage(m){
                this.image = m.image;
                $('#showImageModal').modal('show')
            },
            addMovie(){
                this.movie.id= null;
                this.movie.title= '';
                this.movie.aparat_link= '';
                this.movie.tags= '';
                this.movie.content= '';
                this.modalTitle= 'افزودن ویدیو جدید';
                $('#movieModal').modal('show')
            },
            editMovie(movie){
                this.movie.id= movie.id;
                this.movie.title= movie.title;
                this.movie.aparat_link= movie.aparat_link;
                this.movie.tags= movie.tags;
                if (movie.content)
                    this.movie.content= movie.content;
                else
                    this.movie.content = '';
                this.modalTitle= 'ویرایش ویدیو';
                $('#movieModal').modal('show')
            },
            getMovieList() {
                axios.get('/admin/movie-list?page=' + this.page).then(res => {
                    this.list = res.data.data;
                    this.total = res.total;
                    this.lastpage = res.data.last_page;
                });
            },
            changePage(type){
                if (type==='prev' && this.page!==1)
                    this.page = this.page-1;
                if (type==='next' && this.page!==this.lastpage)
                    this.page = this.page+1;
            },
            saveMovie() {
                if(this.movie.aparat_link === '' || this.movie.title==='')
                    Swal.fire({
                        icon: 'error',
                        text: 'لطفا مقادیر ضروری را وارد کنید',
                        showConfirmButton: false,
                        timer: 1500
                    })
                else {
                    axios.post('/admin/save-movie', {movie: this.movie})
                        .then(res => {
                            this.getMovieList();
                            Swal.fire({
                                icon: 'success',
                                text: 'ویدیو مورد نظر با موفقیت ذخیره شد',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#movieModal').modal('hide')
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
            deleteMovie(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: 'btn btn-danger mx-3 px-5',
                        confirmButton: 'btn btn-success mx-3 px-5'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    text: 'آیا نسبت به پاک کردن این ویدیو اطمینان دارید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'خیر',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete("/admin/delete-movie/"+id).then(res => {
                            Swal.fire({
                                icon: 'success',
                                text: 'ویدیو مورد نظر با موفقیت پاک شد',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.getMovieList();
                        });
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
