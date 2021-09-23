<template>
  <div>
      <div class="" v-if="loading">

      </div>
      <div v-else>
          <div v-if="contacts.length ===0">
              今月誕生日の人はいません
              <router-link to="/contacts/create">データを作成する</router-link>
          </div>

          <div v-for="contact in contacts">
              <router-link :to="'/contacts/'+contact.data.contact_id" class="flex pt-3 items-center
              border-b border-gray-400 hover:bg-gray-200 hover:no-underline">
                  <UserCircle :name="contact.data.name" />
                  <div class="ml-4">
                      <p class="font-bold text-blue-600">{{contact.data.name}}</p>
                      <p class="font-bold text-gray-600">{{contact.data.company}}</p>
                  </div>
              </router-link>
          </div>

      </div>
  </div>
</template>

<script>
import UserCircle from "./UserCircle.vue";
export default {
    name: "ContactList",
    components: {
        UserCircle,
    },
    data: function() {
        return {
            loading: true,
            contacts: null,
        }
    },
    props:[
      'root'
    ],
    mounted() {
        axios.get(this.root)
            .then(response => {
                this.contacts = response.data.data;
                this.loading = false;
            })
            .catch(error => {
                this.loading = false;
                alert('データを取得できませんでした');
            });
    },
}
</script>

<style scoped>
</style>
