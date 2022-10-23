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