<template>
  <div class="ContentBlog">
    <section class="cta-section theme-bg-light py-5">
      <div class="container text-center single-col-max-width">
        <h2 class="heading">BFFBlog - A Blog For Developers</h2>
        <div class="intro">Welcome to my blog 🥰 Check out my project 💻
</div>
        <!--//single-form-max-width-->
      </div>
      <!--//container-->
    </section>

    <!-- <section class="blog-list px-3 py-5 p-md-5">
      <div class="container single-col-max-width">
        <div class="item mb-5" v-for="project in projects.data" :key="project.projectid">
          <div class="row g-3 g-xl-0">
            <div class="col-2 col-xl-3">
              <img
                class="img-fluid post-thumb"
                v-bind:src="'https://res.cloudinary.com/dtiazqxyd/image/upload/v1648266992/'+ project.imagepost"
                alt="image"
              />
            </div>
            <div class="col">
              <h3 class="title mb-1">
                <a class="text-link" @click="$router.push(`/projectdetail/${project.projectid}`)">{{ project.title }}</a>
              </h3>
              <div class="meta mb-1">
                <span class="date">Published by {{project.firstname}} {{project.lastname}}</span
                >
              </div>
              <div
                class="intro"
                v-html="project.short_desc.substring(0, 110) + '...'"
              ></div>
              <a
                class="text-link"
                @click="$router.push(`/projectdetail/${project.projectid}`)"
                >Read more &rarr;</a
              >
            </div>
          
          </div>
         
        </div>
      

    
          <div class="container">
            <div class="row">
              <div class="col">
                <pagination :data="posts" @pagination-change-page="getResults" />
              </div>
            </div>
            
          </div>
  
      
      </div>
    </section> -->

    <div class="container">

<!-- Card deck -->
<div class="card-deck row mt-5">

  <div class="col-xs-12 col-sm-6 col-md-6" v-for="project in projects.data" :key="project.projectid">
  <!-- Card -->
  <div class="card">

    <!--Card image-->
    <div class="view overlay">
      <img style="height:200px" class="card-img-top" v-bind:src="'https://res.cloudinary.com/dtiazqxyd/image/upload/v1648266992/'+ project.imagepost" alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">{{project.title}}</h4>
      <!--Text-->
      <p class="card-text">{{project.short_desc.substring(0, 110) + '...'}}</p>
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
     <div class="my-2 my-md-3">
				    <a class="btn btn-primary" target="_blank" @click="$router.push(`/projectdetail/${project.projectid}`)">Detail</a>
				</div>

    </div>

  </div>
  <!-- Card -->
  </div>

   

  
</div>
<!-- Card deck -->
  
</div>
<!-- Card deck -->
  </div>
</template>

<script>

export default {

  data() {
    return {
      projects: {},
      keywords: "",
      profile: []
    };
  },
//   watch:{
// 	  keywords(after, before){
// 		  this.searchpost();
// 	  }
//   },
  created() {
    this.getAllProject();
  },
  methods: {
    // getResults(page){
    //   axios.get(`/api/getresultpost?page=${page}&keywords=${this.keywords}`)
    //   .then((res) => {
    //     let data = Object.assign({},res.data);
  
    //       this.posts = data;
    //   }).catch((err)=> {
    //     console.log(err);
    //   });

    // },
    // searchpost() {
    //   axios
    //     .get("/api/post", { params: { keywords: this.keywords } })
    //     .then((res) => {
    //         let data = Object.assign({},res.data);
  
    //       this.posts = data;
    //     })
    //     .catch((err) => {
    //       console.log(err);
    //     });
    // },
    getAllProject() {
      axios
        .get("/api/getproject")
        .then((res) => {
 
           let data = Object.assign({},res.data);
  
          this.projects = data;
          
          console.log(this.projects);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>