<template>
    <div class="Listcategory">
        <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category /</span>All</h4>
               <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Category</h5>
                  <p class="mb-4">
                    Add new categories to make your blog more divisional of
                    articles
                  </p>

                  <router-link class="btn btn-sm btn-success" to='/add-category'>
                    <i class='bx bx-plus-circle'></i>
                  </router-link>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    v-bind:src="'images/undraw_Post_re_mtr4.png'"
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
              <!-- Responsive Table -->
              <div class="card">
                <h5 class="card-header">Data Table</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(cate, index) in categories" :key="cate.id">
                        <th>{{cate.name}}</th>
                        <td>{{cate.description}}</td>
                        <td>
                          <button @click="$router.push(`/edit-category/${cate.id}`)" class="btn btn-warning"><i class='bx bxs-edit' ></i></button>
                           <button @click="deletecate(cate.id, index)" class="btn btn-danger"><i class='bx bx-trash' ></i></button>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Table -->
            </div>
    </div>
</template>
<script>
export default {
    name:"Listcategory",
    data(){
        return {
            categories: [],
        }
    },
    created(){
      this.getAllCategory();
    },
    methods:{
      deletecate(id, idx){
        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
        .delete(`/category/${id}`)
        .then(() => {
          this.categories.splice(idx, 1);
          Toast.fire({
            icon: "success",
            title: "Category successfully deleted!",
          });
        })
        .catch((err) => {
          console.log(err);
        });
        }
      });

      },
      getAllCategory(){
        axios.get('/api/getcategory')
        .then((res) => {
          this.categories = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
      }
    }
}
</script>