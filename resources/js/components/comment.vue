<template>
    <div>
        <div class="bg-white my-5" style="box-shadow: 0 0 5px 0 #dfdfdf;">
            <div class="p-4">
                <div class="pb-4">
                    <h5 class="font16">لطفا با ثبت نظر خودتون در مورد این مکان به کاربران ما دید بهتری دهید</h5>
                    <textarea class="form-control" v-model="comment" rows="3" placeholder="نظر خودتان را بنویسید..."></textarea>
                    <button @click="saveComment" class="btn btn-primary btn-sm px-5 float-left mt-2">ارسال نظر</button>
                </div>
            </div>
            <div class="p-4 bg-gray border-top border-bottom">
                {{comments.length}} نظر ثبت شده است
                <div class="float-left d-inline-block">
                    <div class="form-check d-inline-block pl-5">
                        <input class="form-check-input" type="radio" style="margin: 5px -16px 0 0" v-model="ordering" value="new" checked>
                        <label class="form-check-label">
                            جدیدترین نظر
                        </label>
                    </div>
                    <div class="form-check d-inline-block">
                        <input class="form-check-input" type="radio" style="margin: 5px -16px 0 0" v-model="ordering" value="old">
                        <label class="form-check-label">
                            قدیمی ترین نظر
                        </label>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div v-for="item in comments" class="rounded bg-comments p-4 mb-3" style="box-shadow: 0 0 4px 0 #dfdfdf;">
                    <div>
                        <h6 class="widthfit d-inline-block mb-0" v-if="item.user">{{item.user.fullname}}</h6>
                        <h6 class="widthfit d-inline-block mb-0" v-else>کاربر مهمان</h6>
                        <button @click="likeComment(item.id)" class="btn btn-light btn-sm border float-left" style="margin-top: -5px">
                            <i class="fas fa-heart"></i>
                            {{item.like}}
                        </button>
                        <span class="float-left mx-3 font13 text-secondary">{{item.created_at|date('jD jMMMM jYYYY')}}</span>
                        <p class="mt-2 mb-0">
                            {{item.comment}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from "sweetalert2";

    export default {
        name: "comment",
        props: ['place_id'],
        data(){
            return{
                ordering:'new',
                comments:[],
                comment:'',
            }
        },
        watch: {
            ordering: function () {
                this.getComment();
            },
        },
        mounted() {
            this.getComment();
        },
        methods:{
            getComment(){
                axios.get('/get-comment/'+this.place_id+'?ordering='+this.ordering).then(res => {
                    this.comments = res.data;
                });
            },
            likeComment(id){
                axios.get('/comment-like/'+id).then(res => {
                    if (res.data==='ADD') this.getComment();
                });
            },
            saveComment(){
                if (this.comment.length < 5)
                    Swal.fire({
                        icon: 'error',
                        text: 'لطفا متن نظر خود را به درستی وارد کنید',
                        showConfirmButton: false,
                        timer: 2000
                    })
                else{
                    axios.post('/save-comment', {comment:this.comment, place_id:this.place_id}).then(res => {
                        this.comment = '';
                        Swal.fire({
                            icon: 'success',
                            text: 'با تشکر، نظر شما با موفقیت ثبت شد و بعد از تایید نمایش داده خواهد شد.',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>
