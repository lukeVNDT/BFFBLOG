<template>
    <div class="AboutMe">
        <article class="about-section py-5">
		    <div class="container">
			   <div v-html="profile.details"></div>
		    </div>
	    </article><!--//about-section-->
    </div>
</template>

<script>
export default {
	data(){
		return {
			profile:[]
		}
	},
	created(){
		this.getprofile();
	},
	methods:{
		getprofile(){
      axios.get('/user')
      .then((res) => {
        if(res.data.length > 0){
          this.profile = res.data[0];
        }
        else{
          console.log('has default value');
        }
      })
      .catch((err) => {
        console.log(err);
      })
    }

	}
}
</script>