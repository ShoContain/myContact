<template>
  <table class="table">
      <thead class="thead-light">
          <tr>
              <th>ID</th>
              <th>名前</th>
              <th>メールアドレス</th>
              <th>メッセージの数 <button type="button" @click="sort()"><i class="fa fa-sort" style="font-size:20px"></i></button></th>
              <th>ユーザーの削除</th>
          </tr>
      </thead>
      <tbody v-if='showDefault'>
        <tr v-for="(user,index) in usersNew" 　:key="user.id">
            <th>{{user.id}}</th>
            <th>{{user.name}}</th>
            <th>{{user.email}}</th>
            <th>{{user.messages_count}}</th>
            <th><input type="button" class="btn-outline-secondary" value="削除" @click="del(user.id,index)"></th>
        </tr>
      </tbody>
      <tbody v-else>
        <tr v-for="(user,index) in usersSort" 　:key="user.id">
            <th>{{user.id}}</th>
            <th>{{user.name}}</th>
            <th>{{user.email}}</th>
            <th>{{user.messages_count}}</th>
            <th><input type="button" class="btn-outline-secondary" value="削除" @click="del(user.id,index)"></th>
        </tr>
      </tbody>
  </table>
</template>

<script>
export default {
    props: ['users'],
    data() {
        return {
            usersNew: this.users,
            usersSort: [],
            showDefault:true,
            info:''
        }
    },
    methods: {
        del:function(userId,index) {
            if (confirm('このユーザーを削除していいですか？')) {
              axios.delete('user/destory/'+userId,{users:this.usersNew})
            .then(response=>(this.info=response),(this.usersSort.splice(index, 1),this.usersNew.splice(index,1)))
            .catch(error=>{
              console.log(error);
            }); //index番目から1つだけ（つまり該当のindex）を差し替える

        }
      },
      sort(){
        let sortList = [];
        for(let x in this.usersNew){
          sortList.push(this.usersNew[x]);
        }
          sortList.sort(function(a,b){
          return a.messages_count - b.messages_count;
        });
        if(this.showDefault==false){
          this.showDefault=true;
        }else{
          this.showDefault = false;
          this.usersSort = sortList;
        }
      },
  }
}
</script>
<style media="screen">

</style>
