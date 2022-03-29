<template>
  <div class="ListPost">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Project/</span> List project
      </h4>

      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Project</h5>
                <p class="mb-4">
                  Make sure to keep up to date with new articles that can keep
                  readers interested
                </p>

                <router-link class="btn btn-sm btn-success" to="/addproject">
                  <i class="bx bx-plus-circle"></i>
                </router-link>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  v-bind:src="'images/undraw_project_team_lc5a.png'"
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
      <!-- Grid Card -->
      
      <h6 class="pb-1 mb-4 text-muted">All</h6>
      <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <div
          v-for="(project, index) in projectList.data"
          :key="project.projectid"
          class="col"
        >
          <div class="card h-100">
            <img
              class="card-img-top"
              :src="'https://res.cloudinary.com/dtiazqxyd/image/upload/v1648266992/' + project.imagepost"
              alt="Card image cap"
            />
            <div class="card-body">
              <h5 class="card-title">{{ project.title }}</h5>
              <p
                v-html="project.short_desc.substring(0, 100) + '...'"
                class="card-text"
              ></p>
              <button
                @click="$router.push(`/editproject/${project.projectid}`)"
                class="btn btn-warning"
              >
                <i class="bx bxs-edit"></i>
              </button>
              <button @click="deleteProject(project, index)" class="btn btn-danger">
                <i class="bx bx-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <pagination :data="projectList" @pagination-change-page="getResults" />
        </ul>
      </nav>
    </div>
  </div>
</template>
<script>
export default {
  name: "Project",
  data() {
    return {
      projectList: {},
      keywords: "",
    };
  },
//   watch: {
//     keywords(after, before) {
//       this.searchpost();
//     },
//   },
  created() {
    this.getAllProject();
  },
  methods: {
    getResults(page) {
      axios
        .get(`/api/getresultproject?page=${page}`)
        .then((res) => {
          let data = Object.assign({}, res.data);

          this.projectList = data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    searchpost() {
      axios
        .get("/api/post", { params: { keywords: this.keywords } })
        .then((res) => {
          this.postList = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getAllProject() {
      axios
        .get("/api/getproject")
        .then((res) => {
          this.projectList = res.data;
          console.log(this.projectList);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    deleteProject(project, index) {
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
            .delete(`/project/${project.projectid}`)
            .then(() => {
              this.projectList.data.splice(index, 1);
              
              Toast.fire({
                icon: "success",
                title: "Project successfully deleted!",
              });
            })
            .catch((err) => {
              console.log(err);
            });
        }
      });
    },
  },
};
</script>