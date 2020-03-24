<template>
  <ContactList root="/api/birthdays"/>
</template>

<script>
import ContactList from '../components/ContactList';
export default {
  name:"BirthdayIndex",
  components:{
    ContactList,
  }
}
</script>

<style scoped>
</style>
