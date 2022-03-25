<template>
  <div class="ListPost">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Post/</span> List post
      </h4>

      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Post</h5>
                <p class="mb-4">
                  Make sure to keep up to date with new articles that can keep
                  readers interested
                </p>

                <router-link class="btn btn-sm btn-success" to="/addpost">
                  <i class="bx bx-plus-circle"></i>
                </router-link>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  v-bind:src="'images/blogs-and-article.png'"
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
      <div class="row mb-3">
        <div class="col-sm-4">
          <div class="input-group input-group-merge">
            <span id="basic-icon-default-fullname2" class="input-group-text"
              ><i class="bx bx-search"></i
            ></span>
            <input
              v-model="keywords"
              type="text"
              class="form-control"
              id="basic-icon-default-fullname"
              placeholder="Search..."
              aria-label="John Doe"
              aria-describedby="basic-icon-default-fullname2"
            />
          </div>
        </div>
      </div>
      <h6 class="pb-1 mb-4 text-muted">All</h6>
      <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <div
          v-for="(post, index) in postList.data"
          :key="post.postid"
          class="col"
        >
          <div class="card h-100">
            <img
              class="card-img-top"
              v-bind:src="'uploadimage/' + post.imagepost"
              alt="Card image cap"
            />
            <div class="card-body">
              <h5 class="card-title">{{ post.title }}</h5>
              <p
                v-html="post.short_desc.substring(0, 100) + '...'"
                class="card-text"
              ></p>
              <button
                @click="$router.push(`/edit-post/${post.postid}`)"
                class="btn btn-warning"
              >
                <i class="bx bxs-edit"></i>
              </button>
              <button @click="deletePost(post, index)" class="btn btn-danger">
                <i class="bx bx-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <pagination :data="postList" @pagination-change-page="getResults" />
        </ul>
      </nav>
    </div>
  </div>
</template>
<script>
export default {
  name: "Post",
  data() {
    return {
      postList: {},
      keywords: "",
    };
  },
  watch: {
    keywords(after, before) {
      this.searchpost();
    },
  },
  created() {
    this.getAllPost();
  },
  methods: {
    getResults(page) {
      axios
        .get(`/api/getresultpost?page=${page}&keywords=${this.keywords}`)
        .then((res) => {
          let data = Object.assign({}, res.data);

          this.postList = data;
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
    getAllPost() {
      axios
        .get("/api/getpost")
        .then((res) => {
          this.postList = res.data;
          console.log(this.postList);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    deletePost(post, index) {
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
            .delete(`/post/${post.postid}`)
            .then(() => {
              this.postList.data.splice(index, 1);
              
              Toast.fire({
                icon: "success",
                title: "Post successfully deleted!",
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