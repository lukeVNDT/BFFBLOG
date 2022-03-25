<template>
    <div class="PostDetail">
        <article class="blog-post px-3 py-5 p-md-5" v-for="post in postdetail" :key="post.id">
		    <div class="container single-col-max-width">
			    <header class="blog-post-header">
				    <h2 class="title mb-2">{{post.title}}</h2>
				    <!-- <div class="meta mb-3"><span class="date">Published </span></div> -->
			    </header>
			    
			    <div class="blog-post-body">
				    
				    <p v-html="post.description"></p>
				    
				   
				   
			    </div>
				    
				
				<!-- <nav class="blog-nav nav nav-justified my-5">
				  <a class="nav-link-prev nav-item nav-link rounded-left" href="#">Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
				  <a class="nav-link-next nav-item nav-link rounded-right" href="#">Next<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
				</nav> -->
				
				<div class="blog-comments-section">
					<div id="disqus_thread"></div>
					
				</div><!--//blog-comments-section-->
				
		    </div><!--//container-->
	    </article>
    </div>
</template>

<script>
export default {
	data(){
		return {
			postdetail:[]
		}
	},
	mounted(){
		this.getDetail();
	},
	methods:{
		
		getDetail(){
			let id = this.$route.params.id;
      axios.get(`/api/geteditpost/${id}`)
      .then((res) => {
        this.postdetail = res.data;
		console.log(this.postdetail);
      });
		}
	}
}
</script>