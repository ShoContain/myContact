<template>
  <div class="">
    <form @submit.prevent="submitForm">

      <InputField name="name" label="お名前" placeholder="山田　太郎" @update:field="form.name=$event" :errors="error"/>
      <InputField name="email" label="Email" placeholder="example@email.com" @update:field="form.email=$event" :errors="error"/>
      <InputField name="company" label="会社名" placeholder="〇〇株式会社" @update:field="form.company=$event" :errors="error"/>
      <InputField name="birthday" label="お誕生日" placeholder="年/月/日"  @update:field="form.birthday=$event" :errors="error" />

      <div class="flex justify-end pt-3 ">
        <button type="button" name="button"　class="rounded mr-3 p-2 text-red-500 border hover:bg-gray-300 hover:text-red-400 uppercase">Cancel</button>
        <button type="submit" name="button" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700">入力する</button>
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
      axios.post('/api/contacts',this.form)
      .then(response=>{
        this.$router.push(response.data.links.self);
      })
      .catch(errors=>{
        this.error = errors.response.data.errors;
      });
    }
  },
}
</script>

<style scoped>
</style>
