<template>
  <div class="tracking-widest rounded-full border border-gray-400 bg-blue-300 text-white flex h-10 w-10 justify-center items-center ">
      {{userCircle}}
  </div>
</template>

<script>
export default {
  props:['name'],
  computed:{
    userCircle(){
      const name = this.name.match(/[\p{sc=Hiragana}+\p{sc=Katakana}+\p{sc=Han}+\w]+/gu);
      const names = name.map(function(names){
        return names.charAt(0);
      });
      return names.join('');
    }
  }
}
</script>

<style  scoped>
</style>
