<template>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>メッセージ数</th>
            <th>ユーザーの削除</th>
            <th>並び替え</th>
        </tr>
    </thead>

    <draggable :list='usersNew' :options="{animation:200,handle:'.my-handle'}" :element="'tbody'" @change="update">
        <tr v-for="(user,index) in usersNew" 　:key="user.id">
            <th>{{user.id}}</th>
            <th>{{user.name}}</th>
            <th>{{user.email}}</th>
            <th>{{user.messages_count}}</th>
            <th><input type="button" class="btn-outline-secondary" value="削除" @click="del(user.id,index)"></th>
            <th><i class="fa fa-arrows my-handle"></i></th>
        </tr>
    </draggable>
</table>
</template>

<script>
import draggable from 'vuedraggable'
export default {
    components: {
        draggable
    },
    props: ['users'],
    data() {
        return {
            usersNew: this.users,
            message: "hello Im Tom Im new here",
        }
    },
    methods: {
        update() {
            this.usersNew.map((user, index) => {
                user.id = index + 1;
            })
            axios.put('user/update', {
                users: this.usersNew
            }).then((response)=>{
                //success message
            })
          },
        del:function(userId,index) {
            if (confirm('このユーザーを削除していいですか？')) {
              axios.delete('user/destory/'+userId,{users:this.usersNew})
            .then(response=>this.users.splice(index, 1)); //index番目から1つだけ（つまり該当のindex）を差し替える
        }
      },
  }
}
</script>
<style media="screen">
.my-handle {
    cursor: move;
}
</style>
