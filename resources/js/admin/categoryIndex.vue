<template>
    <div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <h4 class="text-primary">
                    <i class="fas fa-chevron-circle-left"></i>
                    مدیریت دسته ها</h4>
            </div>
            <div class="col-lg-6 text-left">
                <button class="btn btn-sm btn-success px-4" @click="addCategory">افزودن دسته جدید</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">عنوان دسته</th>
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
                <td class="text-center">{{c.created_at|date('jYYYY/jM/jD  -  HH:mm')}}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-purple" @click="editDescriptionCategory(c)">توضیحات</button>
                    <button class="btn btn-sm btn-primary" @click="editCategory(c)">ویرایش</button>
                    <button class="btn btn-sm btn-dark" @click="deleteCategory(c.id)">حذف</button>
                </td>
            </tr>
            </tbody>
        </table>






        <!-- Add Edit Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="mb-0 mt-2">{{modalTitle}}</h4>
                        <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">عنوان دسته بندی</label>
                                <input type="text" class="form-control" v-model="category.title">
                            </div>
                            <div class="col-md-12 mb-3 pt-4 text-left">
                                <button class="btn  btn-block btn-primary px-5" @click="saveCategory">ذخیره دسته بندی</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Add Edit Modal -->
        <div class="modal fade" id="categoryDescriptionModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="mb-0 mt-2">توضیحات مربوط به دسته {{contentTitle}}</h4>
                        <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <editor v-model="category.content"
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
                                <button class="btn  btn-block btn-primary px-5" @click="saveCategory">ذخیره توضیحات دسته</button>
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
        name: "categoryIndex",
        data(){
            return{
                list: [],
                modalTitle: 'افزودن دسته بندی جدید',
                category:{
                    id: null,
                    title: '',
                    content: '',
                },
                contentTitle: '',
            }
        },
        mounted() {
            this.getCategoryList();
        },
        components: {
            'editor': Editor
        },
        methods:{
            addCategory(){
                this.category.id= null;
                this.category.title= '';
                this.modalTitle= 'افزودن دسته بندی جدید';
                $('#categoryModal').modal('show')
            },
            editCategory(category){
                this.category.id= category.id;
                this.category.title= category.title;
                this.modalTitle= 'ویرایش دسته بندی';
                $('#categoryModal').modal('show')
            },
            editDescriptionCategory(category){
                if (category.content)
                    this.category.content= category.content;
                else
                    this.category.content = '';
                this.contentTitle = category.title;
                $('#categoryDescriptionModal').modal('show')
            },
            getCategoryList() {
                axios.get('/admin/category-list').then(res => {
                    this.list = res.data;
                });
            },

            saveCategory() {
                if(this.category.title === '')
                    Swal.fire({
                        icon: 'error',
                        text: 'لطفا مقدار عنوان دسته بندی را وارد کنید',
                        showConfirmButton: false,
                        timer: 1500
                    })
                else {
                    axios.post('/admin/save-category', {category: this.category})
                        .then(res => {
                            this.getCategoryList();
                            Swal.fire({
                                icon: 'success',
                                text: 'دسته بندی مورد نظر با موفقیت ذخیره شد',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#categoryModal').modal('hide')
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
            deleteCategory(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: 'btn btn-danger mx-3 px-5',
                        confirmButton: 'btn btn-success mx-3 px-5'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    text: 'آیا نسبت به پاک کردن این دسته بندی اطمینان دارید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'خیر',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete("/admin/delete-category/"+id).then(res => {
                            Swal.fire({
                                icon: 'success',
                                text: 'دسته مورد نظر با موفقیت پاک شد',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.getCategoryList();
                        });
                    }
                })
            }
        }
    }
</script>


<style scoped>

</style>
