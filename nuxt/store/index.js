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
    },
    setOGP(state, payload) {
        state.ogpData = payload;
    }
}

export const actions = {
    async setMessage({commit}, payload) {
        const res = await this.$axios.$post('api/message', payload)
        if (res) {
            // これでリダイレクトを記述できる
            this.$router.push(`/message/${res['uuid']}`);
        }
    },
    setLoading({commit}, payload) {
        commit('setLoading', payload)
    },
    async getOPG({commit}, payload) {
        const data = await this.$axios.$get(`/api/message/${payload}`);
        commit("setOGP", data);
    }
}

export const getters = {
    message(state) {
        return state.message;
    },
    loading(state) {
        return state.load
    },
    ogpData(state) {
        return state.ogpData;
    }
}