<template>
    <div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <h4 class="text-primary">
                    <i class="fas fa-chevron-circle-left"></i>
                    مدیریت کامنت ها</h4>
            </div>
            <div class="col-lg-6 text-left">
            </div>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">مکان</th>
                <th class="text-center" scope="col">کاربر</th>
                <th class="text-center" scope="col">آدرس IP</th>
                <th class="text-center" scope="col" width="50%">متن کامنت</th>
                <th class="text-center" scope="col">پسند</th>
                <th class="text-center" scope="col">تاریخ ثبت</th>
                <th class="text-center" scope="col" width="13%">
                    <i class="fas fa-cogs fa-lg"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="c in list" :class="c.publish?'table-success':''">
                <th class="text-center" scope="row">{{c.id}}</th>
                <td class="text-center">{{c.place.title}}</td>
                <td class="text-center" v-if="c.user">{{c.user.name}}</td>
                <td class="text-center" v-else>کاربر میهمان</td>
                <td class="text-center">{{c.ip_address}}</td>
                <td class="text-center">{{c.comment}}</td>
                <td class="text-center">{{c.like}}</td>
                <td class="text-center">{{c.created_at|date('jYYYY/jM/jD  -  HH:mm')}}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-danger mb-1" @click="changePublish(c.id, 0)" v-if="c.publish">عدم نمایش</button>
                    <button class="btn btn-sm btn-success mb-1" @click="changePublish(c.id, 1)" v-else>نمایش</button>
                    <button class="btn btn-sm btn-dark mb-1" @click="deleteComment(c.id)">حذف</button>
                    <button class="btn btn-sm btn-primary mb-1" @click="editComment(c)">ویرایش</button>
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
        <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="mb-0 mt-2">ویرایش متن کامنت</h4>
                        <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="mb-0">متن کامنت</label>
                                <textarea class="form-control" v-model="comment" rows="5"></textarea>
                            </div>

                            <div class="col-md-12 mb-3 pt-4 text-left">
                                <button class="btn  btn-block btn-primary px-5" @click="saveContent">ویرایش متن کامنت</button>
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
        name: "comment",
        data(){
            return{
                list: [],
                page: 1,
                total: 0,
                lastpage: 0,
                comment: '',
                comment_id: null,
            }
        },
        watch: {
            page: function () {
                this.getCommentList();
            },
        },
        mounted() {
            this.getCommentList();
        },
        methods:{
            getCommentList() {
                axios.get('/admin/comment-list?page=' + this.page).then(res => {
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
            changePublish(id, publish) {
                axios.get('/admin/change-comment-publish/'+id+'/'+publish)
                    .then(res => {
                        this.getCommentList();
                        Swal.fire({
                            icon: 'success',
                            text: 'کامنت مورد نظر با موفقیت ویرایش شد',
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
            saveContent() {
                axios.post('/admin/change-comment-content', {comment: this.comment, id:this.comment_id})
                    .then(res => {
                        this.getCommentList();
                        $('#commentModal').modal('hide')
                        Swal.fire({
                            icon: 'success',
                            text: 'کامنت مورد نظر با موفقیت ویرایش شد',
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

            deleteComment(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: 'btn btn-danger mx-3 px-5',
                        confirmButton: 'btn btn-success mx-3 px-5'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    text: 'آیا نسبت به پاک کردن این کامنت اطمینان دارید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'خیر',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete("/admin/delete-comment/"+id).then(res => {
                            Swal.fire({
                                icon: 'success',
                                text: 'کامنت مورد نظر با موفقیت پاک شد',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.getCommentList();
                        });
                    }
                })
            },
            editComment(comment){
                this.comment_id = comment.id;
                this.comment = comment.comment;
                $('#commentModal').modal('show')
            }
        }
    }
</script>

<style scoped>

</style>
