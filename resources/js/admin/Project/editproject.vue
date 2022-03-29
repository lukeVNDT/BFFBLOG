<template>
  <div class="AddPost">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Project/</span> Edit project
      </h4>
      <form v-on:submit.prevent="editProject">
        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Edit project</h5>
                  <p class="mb-4">
                    Make sure to keep up to date with new articles that can keep
                    readers interested
                  </p>

                  
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    v-bind:src="'/images/undraw_project_team_lc5a.png'"
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
          <div class="col-lg-10">
            <div class="card mb-4">
              <div
                class="
                  card-header
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                <h5 class="mb-0">Form</h5>
                <small class="text-muted float-end">Default label</small>
              </div>
              <div class="card-body">
                <form>
                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          v-if="projects.imagepost == ''"
                          :src=" 'images/1.png'"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <img
                          v-else
                          :src="'https://res.cloudinary.com/dtiazqxyd/image/upload/v1648266992/' + projects.imagepost"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                            @change="uploadAndReset"
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                         
                        </div>
                      </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname"
                      >Title</label
                    >
                    <div class="input-group input-group-merge">
                      <span
                        id="basic-icon-default-fullname2"
                        class="input-group-text"
                        ><i class="bx bx-captions bx-flip-vertical"></i
                      ></span>
                      <input
                        v-model="projects.title"
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="Title..."
                        aria-label="John Doe"
                        aria-describedby="basic-icon-default-fullname2"
                      />
                    </div>
                    
                  </div>
                  <p class="text-danger" v-if="!$v.projects.title.required">Please enter title!</p>
                  <p class="text-danger" v-if="!$v.projects.title.min">
                  Title should be at least 3 characters!</p>
                 
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Short Description</label>
                        <textarea v-model="projects.short_desc" rows="4" class="form-control"></textarea>
                      </div>
                      <p class="text-danger" v-if="!$v.projects.short_desc.required">Please enter short description!</p>
                  <p class="text-danger" v-if="!$v.projects.short_desc.min">Short description should be at least 3 characters!</p>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-message"
                      >Content</label
                    >
                    <vue-editor v-model="projects.description"></vue-editor>
                  </div>
                  <p class="text-danger" v-if="!$v.projects.description.required">Please enter content!</p>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card mb-4">
              <div
                class="
                  card-header
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                <h5 class="mb-0">Action</h5>
              </div>
              <div class="card-body">
                <button :disabled="$v.$invalid" type="submit" class="btn btn-primary">
                  <div
                    v-if="loading"
                    class="spinner-border spinner-border-md"
                    style="width: 1rem; height: 1rem"
                  ></div>
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
import { VueEditor } from "vue2-editor";
import { required, minLength } from "vuelidate/lib/validators";
export default {
  components: {
    VueEditor
  },
  data() {
    return {
      loading: false,
      projects: {},
      loading: false,
      avatar: ''
    };
  },
  validations:{
    projects:{
     title:{
        required,
        min: minLength(3)
     },
     short_desc:{
        required,
        min: minLength(3)
     },
      description:{
          required
        }
    },
  },
  created(){
    this.getprojectdata();
  },
  methods: {
    uploadAndReset(e){
      // Update/reset user image of account page
     let accountUserImage = document.getElementById('uploadedAvatar');
        if (e.target.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(e.target.files[0]);
          this.avatar = e.target.files[0];
          console.log(this.avatar);
        }
 
    
    },
    editProject(){
      let id = this.$route.params.id;
      let form  = new FormData();
      form.append('title', this.projects.title);
      form.append('short_desc', this.projects.short_desc);
      form.append('description', this.projects.description);
      form.append('imagepost', this.avatar);
      this.loading = !false;
      setTimeout(()=> {
        axios.post(`/saveproject/${id}`, form)
      .then((res) => {
         Toast.fire({
              icon: "success",
              title: "Project successfully updated!",
            });
            this.loading = !true;
            this.$router.push('/project');
      })
      .catch((err) => {
        Toast.fire({
              icon: "error",
              title: "Opps! something went wrong",
            });
      });
      },2000);
    },
    getprojectdata(){
    let id = this.$route.params.id;
      axios.get(`/api/geteditproject/${id}`)
      .then((res) => {
        this.projects = res.data[0];
        console.log(this.projects);
      });
    },
  },
};
</script>