<template>
  <div class="ContentBlog">
    <section class="cta-section theme-bg-light py-5">
      <div class="container text-center single-col-max-width">
        <h2 class="heading">BFFBlog - A Blog For Developers</h2>
        <div class="intro">Welcome to my blog 🥰</div>
        <div class="single-form-max-width pt-3 mx-auto">
          <form class="signup-form row g-2 g-lg-2 align-items-center">
            <div class="col-12 col-md-12">
              <label class="sr-only" for="semail">Your email</label>
              <input
                v-model="keywords"
                type="email"
                id="semail"
                name="semail1"
                class="form-control me-md-1 semail"
                placeholder="Keyword..."
              />
            </div>
            <!-- <div class="col-12 col-md-2">
              <button type="submit" class="btn btn-primary">Search</button>
            </div> -->
          </form>
          <!--//signup-form-->
        </div>
        <!--//single-form-max-width-->
      </div>
      <!--//container-->
    </section>

    <section class="blog-list px-3 py-5 p-md-5">
      <div class="container single-col-max-width">
        <div class="item mb-5" v-for="post in posts.data" :key="post.postid">
          <div class="row g-3 g-xl-0">
            <div class="col-2 col-xl-3">
              <img
                class="img-fluid post-thumb"
                v-bind:src="'/uploadimage/'+ post.imagepost"
                alt="image"
              />
            </div>
            <div class="col">
              <h3 class="title mb-1">
                <a class="text-link" @click="$router.push(`/postdetail/${post.postid}`)">{{ post.title }}</a>
              </h3>
              <div class="meta mb-1">
                <span class="date">Published by {{post.firstname}} {{post.lastname}}</span
                >
              </div>
              <div
                class="intro"
                v-html="post.short_desc.substring(0, 110) + '...'"
              ></div>
              <a
                class="text-link"
                @click="$router.push(`/postdetail/${post.postid}`)"
                >Read more &rarr;</a
              >
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//item-->

        <!-- <nav class="blog-nav nav nav-justified my-5"> -->
          <!-- <a
            class="nav-link-prev nav-item nav-link d-none rounded-left"
            href="#"
            >Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i
          ></a>
          <a class="nav-link-next nav-item nav-link rounded" href="#"
            >Next<i class="arrow-next fas fa-long-arrow-alt-right"></i
          ></a> -->
          <div class="container">
            <div class="row">
              <div class="col">
                <pagination :data="posts" @pagination-change-page="getResults" />
              </div>
            </div>
            
          </div>
          
        <!-- </nav> -->
      
      </div>
    </section>
  </div>
</template>

<script>

export default {

  data() {
    return {
      posts: {},
      keywords: "",
      profile: []
    };
  },
  watch:{
	  keywords(after, before){
		  this.searchpost();
	  }
  },
  created() {
    this.getAllPost();
  },
  methods: {
    getResults(page){
      axios.get(`/api/getresultpost?page=${page}&keywords=${this.keywords}`)
      .then((res) => {
        let data = Object.assign({},res.data);
  
          this.posts = data;
      }).catch((err)=> {
        console.log(err);
      });

    },
    searchpost() {
      axios
        .get("/api/post", { params: { keywords: this.keywords } })
        .then((res) => {
            let data = Object.assign({},res.data);
  
          this.posts = data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getAllPost() {
      axios
        .get("/api/getpost")
        .then((res) => {
 
           let data = Object.assign({},res.data);
  
          this.posts = data;
          
          console.log(this.posts);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>