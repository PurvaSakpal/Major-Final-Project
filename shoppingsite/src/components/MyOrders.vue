<template>
  <section id="cart_items">
    <div class="container">
      <router-link class="btn btn-default check_out mb-4" to="/"
        >Check Out Products</router-link
      >
      <div class="table-responsive cart_info">
        <table class="table table-condensed p-3">
          <thead>
            <tr class="cart_menu">
              <td class="image">Sr.no</td>
              <td class="name">Name</td>
              <td class="price">Image</td>
              <td class="quantity">Description</td>
              <td class="total">Quantity</td>
              <td class="total">Cart Sub Total</td>
              <td class="total">Coupon Applied</td>
              <td class="total">Total</td>
              <td></td>
            </tr>
          </thead>
          <tbody v-for="(useradd, i) in useraddress" :key="i">
            <tr
              v-for="userord in useradd.userorder"
              :key="userord.index"
              class="mb-3"
            >
              <td>{{ i + 1 }}</td>
              <td v-for="product in products" :key="product.index">
                <span v-if="userord.product_id == product.id">
                  {{ product.name }}
                </span>
              </td>
              <td v-for="product in products" :key="product.index">
                <template v-if="userord.product_id == product.id">
                  <img
                    :src="url + product.images[0].image"
                    alt=""
                    width="100px"
                    height="100px"
                    class="mb-2"
                  />
                </template>
              </td>
              <td v-for="product in products" :key="product.index">
                <template v-if="userord.product_id == product.id">
                  {{ product.description }}
                </template>
              </td>
              <td>
                {{ userord.product_quantity }}
              </td>
              <td>
                {{ useradd.orderdetail.cart_sub_total }}
              </td>
              <td v-if="useradd.orderdetail.coupon_id">Applied</td>
              <td v-else>Not applied</td>
              <td>{{ useradd.orderdetail.total }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
import { MyOrders } from "@/Common/Service";
export default {
  name: "MyOrders",
  data() {
    return {
      useraddress: [],
      products: [],
      url: "http://127.0.0.1:8000/ProductImages/",
    };
  },
  watch: {
    $route(to) {
      this.param = to.params.id;
      MyOrders(this.param).then((res) => {
        this.useraddress = res.data.useraddress;
        this.products = res.data.products;
        console.log(res.data.useraddress);
      });
    },
  },
  created() {
    this.param = this.$route.params.id;
  },
  mounted() {
    MyOrders(this.param)
      .then(($res) => {
        console.log($res.data.useraddress);
        console.log($res.data.products);
        this.useraddress = $res.data.useraddress;
        this.products = $res.data.products;
      })
      .catch((error) => {
        console.log("Something went wrong" + error);
      });
  },
};
</script>

<style>
</style>