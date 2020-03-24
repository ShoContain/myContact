<template>
  <div class="">

    <div class="flex justify-between">
        <a href='#' class="text-blue-400" @click="$router.back()"> < Back</a>
    </div>

    <form @submit.prevent="submitForm" class="pt-8">

      <InputField name="name" label="名前" placeholder="山田　太郎" @update:field="form.name=$event" :errors="error" :data = "form.name" />
      <InputField name="email" label="Email" placeholder="example@email.com" @update:field="form.email=$event" :errors="error" :data = "form.email" />
      <InputField name="company" label="会社名" placeholder="〇〇株式会社" @update:field="form.company=$event" :errors="error" :data = "form.company" />
      <InputField name="birthday" label="お誕生日" placeholder="年-月ー日"  @update:field="form.birthday=$event" :errors="error" :data = "form.birthday" />

      <div class="flex justify-end pt-3 ">
        <button @click="cancelEdit()" type="button" name="button"　class="rounded mr-3 p-2 text-red-500 border hover:bg-gray-300 hover:text-red-400 uppercase">Cancel</button>
        <button type="submit" name="button" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700">変更</button>
      </div>

    </form>
  </div>
</template>

<script>
import InputField from "../components/InputField"
export default {
  components:{
    InputField,
  },
  mounted(){
    axios.get('/api/contacts/'+this.$route.params.id)
    .then(response=>{
      this.form = response.data.data;
    }).catch(error=>{
      if(error.response.status === 404){
        this.$router.push('/contacts');
      }
    });
  },
  data:function(){
    return{
      form:{
        'name':'',
        'email':'',
        'company':'',
        'birthday':'',
      },
      error:null,
    }
  },
  methods:{
    submitForm(){
      axios.patch('/api/contacts/'+this.$route.params.id,this.form)
      .then(response=>{
        this.$router.push(response.data.links.self);
      })
      .catch(errors=>{
        this.error = errors.response.data.errors;
      });
    },
    cancelEdit(){
      axios.get('/api/contacts/'+this.$route.params.id)
      .then(response=>{
        this.form = response.data.data;
      }).catch(error=>{
        if(error.response.status === 404){
          this.$router.push('/contacts');
        }
      });
    }
  }
}
</script>

<style scoped>
</style>
