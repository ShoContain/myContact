<template>
  <ContactList root="/api/contacts"/>
</template>

<script>
import ContactList from '../components/ContactList';
export default {
  name:"ContactIndex",
  components:{
    ContactList,
  }
}
</script>

<style scoped>
</style>
