  <template>
  <div class="">
      <div v-if="focus" @click="focus=false" class="bg-black opacity-25 z-10 absolute right-0 left-0 top-0 bottom-0"></div>

      <div class="relative z-10">
          <div class="absolute">
              <svg viewBox="0 0 24 24" class="w-5 h-5 mt-1 ml-2">
                  <path fill-rule="evenodd" d="M20.2 18.1l-1.4 1.3-5.5-5.2 1.4-1.3 5.5 5.2zM7.5 12c-2.7 0-4.9-2.1-4.9-4.6s2.2-4.6 4.9-4.6 4.9 2.1 4.9 4.6S10.2 12 7.5 12zM7.5.8C3.7.8.7 3.7.7 7.3s3.1 6.5 6.8 6.5c3.8 0 6.8-2.9 6.8-6.5S11.3.8 7.5.8z"
                    clip-rule="evenodd" />
              </svg>
          </div>
          <input class="w-64 mr-6 bg-gray-300  pl-8 text-gray-700 rounded-md focus:outline-none" type="text" placeholder="Search..." id="searchTerm" v-model="searchTerm" @input="search" @focus="focus=true">

          <div v-if="focus" class="absolute bg-blue-900 rouded-lg p-4 w-96 right-0 mr-6 mt-2 shadow z-20">
              <div v-if='results == 0' class="text-white">検索結果が該当しませんでした。</div>
              <div v-else>
                  <p class="text-white">{{results.length}}件ヒットしました</p>
                  <div class="" v-for="result in results" :key="result.data.contact_id" @click="focus=false">
                      <router-link :to="result.links.self" class="block py-2 hover:no-underline">
                          <div class="flex items-center border-b border-solid border-gray-100">
                              <UserCircle :name="result.data.name"/>
                              <div class="text-sm text-white pl-4">
                                  <p>{{result.data.name}}</p>
                                  <p>{{result.data.company}}</p>
                              </div>
                          </div>
                      </router-link>
                  </div>
              </div>
          </div>
      </div>

  </div>
  </template>

  <script>
  import _ from "lodash";
  import UserCircle from "./UserCircle";
  export default {
      name: "SearchBar",
      components: {
          UserCircle,
      },
      data() {
          return {
              searchTerm: '',
              focus: false,
              results: [],
          }
      },
      methods: {
          search: _.debounce(function(e) {
              if (this.searchTerm.length < 1) {
                  return;
              }
              axios.post('/api/search', {
                      searchTerm: this.searchTerm
                  })
                  .then(response => {
                      this.results = response.data.data;
                  })
                  .catch(error => {
                      console.log(error.response);
                  });
          }, 500)
      },
  }
  </script>

  <style  scoped>
  </style>
