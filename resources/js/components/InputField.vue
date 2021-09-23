<template>
<div class="relative">
    <label :for="name" class="text-blue-300 text-sm form-bold absolute pt-1 pl-1">{{label}}</label>
    <input type="text" :id="name" :placeholder="placeholder" @input="inputField()"
     v-model="value" :class="errorClassObject()" class="pt-8 w-full border-b focus:outline-none focus:bg-gray-200 foucs:border-blue-400 pl-2 pb-2 text-blue-600">
    <!-- <span v-text="msg"></span>　この２つは同じ　<span>{{msg}}</span> -->
    <p class="text-red-500 text-sm" v-text="errorsMessage()"></p>
</div>
</template>

<script>
export default {

    props: ['name', 'label', 'placeholder', 'errors','data'],
    data: function() {
        return {
            value: '',
        }
    },
    computed:{
      hasError(){
        return this.errors && this.errors[this.name] && this.errors[this.name].length > 0;
      }
    },
    methods: {
        inputField() {
            this.errorClean();
            this.$emit('update:field', this.value);
        },
        errorsMessage() {
            if (this.hasError) {
                return this.errors[this.name][0];
            }
        },
        errorClean() {
            if (this.hasError) {
                this.errors[this.name] = null;
            }
        },
        errorClassObject(){
          return {
            // 'class名'：class名を出力する条件式
            'error-field':this.hasError,
          }
        }
    },
    watch:{
      //dataが変わるごとに実行される関数
      data:function(val){
        this.value = val;
      }
    },
}
</script>

<style lang="css" scoped>
.error-field{
  @apply border-red-500 border-b-2
}
</style>
