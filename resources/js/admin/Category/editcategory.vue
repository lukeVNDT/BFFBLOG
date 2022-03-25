<template>
  <div class="EditCategory">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Category /</span> Edit category
      </h4>
      <form v-on:submit.prevent="editCategory">
        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Edit category</h5>
                  <p class="mb-4">
                    Add new categories to make your blog more divisional of
                    articles
                  </p>

                 
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    v-bind:src="'/images/undraw_Post_re_mtr4.png'"
                    height="140"
                    alt="View Badge User"
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
                    v-model="editdata.name"
                    type="text"
                    class="form-control"
                    id="defaultFormControlInput"
                    placeholder="Category name..."
                    aria-describedby="defaultFormControlHelp"
                  />
                </div>
                

                <p class="text-danger" v-if="!$v.editdata.name.required">
                  Please enter name!
                </p>
                <p class="text-danger" v-if="!$v.editdata.name.min">
                  Name should be at least 3 characters!
                </p>
                 <div>
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea v-model="editdata.description" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                      </div>

                      <p class="text-danger" v-if="!$v.editdata.description.required">
                  Please enter description!
                </p>
                <p class="text-danger" v-if="!$v.editdata.description.min">
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
                  > </div>
                  <i v-else class='menu-icon tf-icons bx bx-save'></i>Save
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
  name: "EditCategory",
  data() {
    return {
      editdata:{},
      loading: false,
    };
  },
  created(){
      this.getEditData();
  },
  validations: {
    editdata: {
      name: {
        required,
        min: minLength(3),
      },
      description:{
        required,
        min: minLength(3),
      }
    }
  },
  methods: {
    editCategory(){
      let id = this.editdata.id;
      const data = {
        name: this.editdata.name,
        description: this.editdata.description
      }


      this.loading = !false;
      setTimeout(()=>{
        axios.post(`/save-category/${id}`, data)
      .then((res) => {
        Toast.fire({
              icon: "success",
              title: "Category successfully saved!",
            });
            this.loading = !true;
            this.$router.push('/category');
      }).catch((err) => {
        Toast.fire({
              icon: "success",
              title: "Something went wrong!",
            });
      });
      },2000);
    },
    getEditData(){
        let id = this.$route.params.id;
        axios.get(`/api/geteditcategory/${id}`)
        .then((res) => {
            this.editdata = res.data[0];
            console.log(this.editdata);
        })
        .catch((err) => {
            console.log(err);
        });
    }
   
  },
};
</script>