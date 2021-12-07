<template>
    <div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <h4 class="text-primary">
                    <i class="fas fa-chevron-circle-left"></i>
                    مدیریت کاربران</h4>
            </div>
            <div class="col-lg-6 text-left">
                <button class="btn btn-sm btn-success px-4" @click="addUser">افزودن کاربر جدید</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">نام کاربری</th>
                <th class="text-center" scope="col">نام و نام خانوادگی</th>
                <th class="text-center" scope="col">شماره موبایل</th>
                <th class="text-center" scope="col">ایمیل کاربر</th>
                <th class="text-center" scope="col">تاریخ ثبت نام</th>
                <th class="text-center" scope="col" width="13%">
                    <i class="fas fa-cogs fa-lg"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="u in list">
                <th class="text-center" scope="row">{{u.id}}</th>
                <td class="text-center">{{u.name}}</td>
                <td class="text-center">{{u.fullname}}</td>
                <td class="text-center">{{u.mobile}}</td>
                <td class="text-center">{{u.email}}</td>
                <td class="text-center">{{u.created_at|date('jYYYY/jM/jD  -  HH:mm')}}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary" @click="editUser(u)">ویرایش</button>
                    <button class="btn btn-sm btn-dark" @click="deleteUser(u.id)">حذف</button>
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
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
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
                                <label class="mb-0">نام کاربری</label>
                                <input type="text" class="form-control" v-model="user.name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">نام کامل کاربر</label>
                                <input type="text" class="form-control" v-model="user.fullname">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">آدرس ایمیل</label>
                                <input type="email" class="form-control" v-model="user.email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">شماره موبایل</label>
                                <input type="text" class="form-control" v-model="user.mobile">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">رمز عبور</label>
                                <input type="text" class="form-control" v-model="user.password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-0">تکرار رمز عبور</label>
                                <input type="text" class="form-control" v-model="user.confirm_password">
                            </div>
                            <div class="col-md-12 mb-3 pt-4 text-left">
                                <button class="btn  btn-block btn-primary px-5" @click="saveUser">ذخیره کاربر</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</template>

<script>
    import Swal from 'sweetalert2'

    export default {
        name: "userIndex",
        data(){
            return{
                list: [],
                page: 1,
                total: 0,
                lastpage: 0,
                modalTitle: 'افزودن کاربر جدید',
                user:{
                    id: null,
                    name: null,
                    fullname: null,
                    mobile: null,
                    email: null,
                    password: '',
                    confirm_password: '',
                }
            }
        },
        watch: {
            page: function () {
                this.getUserList();
            },
        },
        mounted() {
            this.getUserList();
        },
        methods:{
            addUser(){
                this.user.id= null;
                this.user.fullname= null;
                this.user.name= null;
                this.user.mobile= null;
                this.user.email= null;
                this.user.password= '';
                this.user.confirm_password= '';
                this.modalTitle= 'افزودن کاربر جدید';
                $('#userModal').modal('show')
            },
            editUser(user){
                this.user.id= user.id;
                this.user.name= user.name;
                this.user.fullname= user.fullname;
                this.user.mobile= user.mobile;
                this.user.email= user.email;
                this.user.password= '';
                this.user.confirm_password= '';
                this.modalTitle= 'ویرایش کاربر';
                $('#userModal').modal('show')
            },
            getUserList() {
                axios.get('/admin/user-list?page=' + this.page).then(res => {
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
            saveUser() {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                if (!re.test(String(this.user.email).toLowerCase()))
                    Swal.fire({
                        icon: 'error',
                        text: 'فیلد ایمیل را به درستی وارد کنید',
                        showConfirmButton: false,
                        timer: 1500
                    })
                else if (this.user.mobile.length !== 11 || !this.user.mobile.startsWith('09'))
                    Swal.fire({
                        icon: 'error',
                        text: 'فیلد شماره موبایل را به درستی وارد کنید',
                        showConfirmButton: false,
                        timer: 1500
                    })
                else if(this.user.id === null && (this.user.password==='' || this.user.confirm_password==='' || this.user.password.length<4))
                    Swal.fire({
                        icon: 'error',
                        text: 'لطفا مقادیر رمز عبور را وارد کنید',
                        showConfirmButton: false,
                        timer: 1500
                    })
                else {
                    axios.post('/admin/save-user', {user: this.user})
                        .then(res => {
                            this.getUserList();
                            Swal.fire({
                                icon: 'success',
                                text: 'کاربر مورد نظر با موفقیت ذخیره شد',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#userModal').modal('hide')
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
            deleteUser(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: 'btn btn-danger mx-3 px-5',
                        confirmButton: 'btn btn-success mx-3 px-5'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    text: 'آیا نسبت به پاک کردن این کاربر اطمینان دارید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'خیر',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete("/admin/delete-user/"+id).then(res => {
                            Swal.fire({
                                icon: 'success',
                                text: 'کاربر مورد نظر با موفقیت پاک شد',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.getUserList();
                        });
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
