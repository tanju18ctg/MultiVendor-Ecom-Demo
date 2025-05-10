// import axios from "axios"

export const cart = {
  namespaced: true,
  state: {
    cartItems: [],
    cartItemCount: 0,
  },
  getters: {
    GET_CART_ITEMS(state) {
      return state.cartItems;
    },

    GET_CART_ITEMCOUNT(state) {
      return state.cartItemCount;
    },

    GET_CART_TOTAL(state) {
      let price = 0;
      state.cartItems.map((el) => {
        price += el["price"] * el["quantity"];
      });
      return price;
    },
  },

  actions: {
    ADD_OR_INCREMENT_CART(context, product) {
      context.commit("SET_TO_CART", product);
    },

    DECREMENT_CART(context, product) {
      context.commit("SET_REMOVE_CART", product);
    },

    DELETE_CART(context, product) {
      context.commit("SET_DELETE_CART", product);
    },

    DESTROY_CART(context) {
      context.commit("SET_DESTROY_CART");
    },
  },
  mutations: {
    SET_TO_CART(state, product) {
      let item = product;
      item = { ...item, quantity: 1 };

      if (state.cartItems.length > 0) {
        let bool = state.cartItems.some((i) => i.id === item.id);
        if (bool) {
          let index = state.cartItems.findIndex((el) => el.id === item.id);
          state.cartItems[index]["quantity"] += 1;
        } else {
          state.cartItems.push(item);
        }
      } else {
        state.cartItems.push(item);
      }

      state.cartItemCount++;
    },

    SET_REMOVE_CART(state, product) {
      if (state.cartItems.length > 0) {
        let bool = state.cartItems.some((i) => i.id === product.id);
        if (bool) {
          let index = state.cartItems.findIndex((el) => el.id === product.id);
          if (state.cartItems[index]["quantity"] !== 1) {
            state.cartItems[index]["quantity"] -= 1;
            state.cartItemCount--;
          }

          // if (state.cartItems[index]["quantity"] !== 0) {
          //   state.cartItems[index]["quantity"] -= 1;
          //   state.cartItemCount--
          // }

          // if (state.cartItems[index]["quantity"] === 0) {
          //   state.cartItems.splice(index, 1);
          // }
        }
      }
    },

    SET_DELETE_CART(state, product) {
      if (state.cartItems.length > 0) {
        let bool = state.cartItems.some((i) => i.id === product.id);
        if (bool) {
          let index = state.cartItems.findIndex((el) => el.id === product.id);
          state.cartItemCount -= state.cartItems[index]["quantity"];
          state.cartItems.splice(index, 1);
        }
      }
    },

    SET_DESTROY_CART(state) {
      state.cartItems = [];
      state.cartItemCount = 0;
    },
  },
};
