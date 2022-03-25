<template>
  <div class="Category">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Category /</span> Add category
      </h4>
      <form v-on:submit.prevent="addCategory">
        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Add new category</h5>
                  <p class="mb-4">
                    Add new categories to make your blog more divisional of
                    articles
                  </p>

                 
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    v-bind:src="'images/man-with-laptop-light.png'"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="card mb-4">
              <div class="card-body">
                <div>
                  <label for="defaultFormControlInput" class="form-label"
                    >Name</label
                  >
                  <input
                    v-model="category_name"
                    type="text"
                    class="form-control"
                    id="defaultFormControlInput"
                    placeholder="Category name..."
                    aria-describedby="defaultFormControlHelp"
                  />
                </div>
                

                <p class="text-danger" v-if="!$v.category_name.required">
                  Please enter name!
                </p>
                <p class="text-danger" v-if="!$v.category_name.min">
                  Name should be at least 3 characters!
                </p>
                 <div>
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea v-model="content" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                      </div>

                      <p class="text-danger" v-if="!$v.content.required">
                  Please enter description!
                </p>
                <p class="text-danger" v-if="!$v.content.min">
                  description should be at least 3 characters!
                </p>
              </div>
              
            </div>
          </div>
          <div class="col-md-2">
            <div class="card mb-4">
              <h5 class="card-header">Action</h5>
              <div class="card-body">
                <button
                  :disabled="$v.$invalid"
                  type="submit"
                  class="btn btn-primary"
                >
                  <div
                    v-if="loading"
                    class="spinner-border spinner-border-md"
                    style="width: 1rem; height: 1rem"
                  ></div>
                  <i v-else class="menu-icon tf-icons bx bx-plus"></i>Publish
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import { required, minLength } from "vuelidate/lib/validators";
export default {
  name: "Category",
  data() {
    return {
      category_name: "",
      loading: false,
      content: ''
    };
  },
  validations: {
    category_name: {
      required,
      min: minLength(3),
    },
    content: {
      required,
      min: minLength(3),
    }
  },
  methods: {
    addCategory() {
      const data = {
        name: this.category_name,
        content: this.content
      };
      this.loading = !false;
      setTimeout(() => {
        axios
          .post("save-category", data)
          .then((res) => {
            Toast.fire({
              icon: "success",
              title: "Category successfully added!",
            });
            this.category_name = "";
            this.$router.push('/category');
          })
          .catch((err) => {
             Toast.fire({
              icon: "success",
              title: "Something went wrong!",
            });
          });
        this.loading = !true;
      }, 2000);
    },
  },
};
</script>