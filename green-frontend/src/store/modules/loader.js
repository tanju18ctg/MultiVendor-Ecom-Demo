export const loader = {
    namespaced: true,

    state: {
        loading: false
    },

    getters: {
        GET_LOADING(state) {
            return state.loading;
        },
        
    },

    actions:{
        ADD_LOADING(context,payload){
            context.commit("SET_LOADING",payload)
        }
    },

    mutations: {
        SET_LOADING(state, status) {
            state.loading = status;
        },

    }
}