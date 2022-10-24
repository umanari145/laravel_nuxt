export const state = () => ({
    message: '',
    isLoading: false,
    ogpData: {}
});

export const mutations = {
    setMessage(state, payload) {
        state.message = payload;
    },
    setLoading(state, payload) {
        state.isLoading = payload       
    }
}

export const actions = {
    async setMessage({commit}, payload) {
        const id = await this.$axios.$post('api/message', payload)
        if (id) {
            this.$router.push(`/message/${id}`);
        }
    },
    setLoading({commit}, payload) {
        commit('setLoading', payload)
    }
}

export const getters = {
    message(state) {
        return state.message;
    },
    loading(state) {
        return state.load
    }
}