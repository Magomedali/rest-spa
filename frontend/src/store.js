import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
  	order: {
  		id: null,
  		products: []
  	},
    notification: null
  },
  getters: {
    
  },
  mutations: {
  	setNotification(state, notification) {
      state.notification = notification;
    },
    setOrder(state, order) {
      state.order = order;
    },
    clearOrder(state,order) {
      state.order.id = null;
      state.order.products = [];
    }
  },
  actions: {

  }
})
