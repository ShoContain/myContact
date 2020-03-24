<template>
<div>
    <div v-if="loading">Loading...</div>

    <div v-else>
        <div class="flex justify-between">
            <a href='#' class="text-blue-400" @click="$router.back()"> < Back</a>
                    <div class="relative">
                        <router-link :to="'/contacts/'+contact.contact_id+'/edit'" class="px-4 py-2 mr-4 font-semibold rounded border bg-green-200 text-green-600 hover:bg-green-400 hover:text-white">編集</router-link>
                        <a href="#" @click="modal =! modal" class="px-4 py-2 mr-4 font-semibold rounded bg-red-200 text-red-600 hover:bg-red-400 hover:text-white">削除</a>

                        <div v-if="modal" class="absolute z-20 bg-blue-900 text-white rounded-lg 　p-10 w-64  right-0 p-3">
                            <p class="pt-3 text-sm font-bold">本当に削除しますか？</p>

                            <div class="flex items-center justify-end">
                                <button @click="modal =! modal" class="mr-2 rounded px-2 py-2 text-white bg-gray-600 hover:bg-gray-500">キャンセル</button>
                                <button @click="destroy()" class="bg-red-500 px-2 py-2 rounded hover:bg-red-400">削除する</button>
                            </div>
                        </div>
                    </div>
                    <div v-if="modal" @click="modal=!modal" class="bg-black opacity-25 right-0 left-0 top-0 bottom-0 z-10 absolute"></div>
            </div>


            <div class="flex items-start pt-6">
                <UserCircle :name="contact.name" />
                <p class="pl-6 text-xl">{{contact.name}}</p>
            </div>

            <p　class="pt-8 text-gray-600 text-bold text-sm">メール</p>
            <p class="text-blue-400 font-bold border-b py-2">{{contact.email}}</p>

            <p class="pt-8 text-gray-600 text-bold text-sm">会社名</p>
            <p class="text-blue-400 font-bold border-b py-2 tracking-wider">{{contact.company}}</p>

            <p class="pt-8 text-gray-600 text-bold text-sm">誕生日</p>
            <p class="text-blue-400 font-bold border-b py-2">{{contact.birthday}}</p>
            {{$route.params.id}}
        </div>
    </div>
</template>

<script>
import UserCircle from '../components/UserCircle.vue';
export default {
    name: "ContactShow",
    components: {
        UserCircle,
    },
    mounted() {
        axios.get('/api/contacts/' + this.$route.params.id)
            .then(response => {
                this.contact = response.data.data;
                this.loading = false;
            })
            .catch(error => {
                this.loading = false;
                if (error.response.status === 404) {
                    this.$router.push('/contacts');
                }
            });
    },
    data: function() {
        return {
            loading: true,
            modal: false,
            contact: null,
        }
    },
    methods: {
        destroy() {
            axios.delete('/api/contacts/' + this.$route.params.id)
                .then(response => {
                    this.$router.push('/contacts');
                })
                .catch(error => {
                    alert('削除失敗');
                });
        }
    }
}
</script>

<style  scoped>
</style>
