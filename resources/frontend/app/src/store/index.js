import {createStore} from 'vuex'

export default createStore({
    state: {
        url: 'http://localhost/api/',
    },
    getters: {
        getUrl(state) {
            return state.url;
        },

    },
    mutations: {},
    actions: {},
    modules: {}
})
