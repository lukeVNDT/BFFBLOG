<template>
  <div class="Account">
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
<div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Account setting</h5>
                  <p class="mb-4">
                   Choose your settings for displaying personal information here
                  </p>

                  
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    v-bind:src="'images/undraw_Personal_info_re_ur1n.png'"
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
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                   
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          v-if="profile.image == ''"
                          :src=" 'images/1.png'"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <img
                          v-else
                          :src=" 'https://res.cloudinary.com/dtiazqxyd/image/upload/v1648268980/' + profile.image"
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
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          

                         
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form @submit.prevent="saveProfile" id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input
                              v-model="profile.firstname"
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="firstName"
                              value="John"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input v-model="profile.lastname" class="form-control" type="text" name="lastName" id="lastName" value="Doe" />
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Phone Number</label>
                            <input
                            v-model="profile.number"
                              type="text"
                              class="form-control"
                              id="organization"
                              name="organization"
                              value="ThemeSelection"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Address</label>
                            <div class="input-group input-group-merge">
                              <input
                              v-model="profile.address"
                                type="text"
                                id="phoneNumber"
                                name="phoneNumber"
                                class="form-control"
                              />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Country</label>
                            <input v-model="profile.country" type="text" class="form-control" id="address" name="address" placeholder="Address" />
                          </div>
                          
                          
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="phoneNumber">Facebook link</label>
                            <div class="input-group input-group-merge">
                              <input
                              v-model="profile.fb_link"
                                type="text"
                                id="phoneNumber"
                                name="phoneNumber"
                                class="form-control"
                              />
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="phoneNumber">Github link</label>
                            <div class="input-group input-group-merge">
                              <input
                              v-model="profile.github_link"
                                type="text"
                                id="phoneNumber"
                                name="phoneNumber"
                                class="form-control"
                              />
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="currency" class="form-label">Short description</label>
                            <textarea v-model="profile.shortdescription"  class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                         <div class="mb-3 col-md-12">
                            <label for="currency" class="form-label">Details</label>
                             <vue-editor v-model="profile.details"></vue-editor>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">
                             <div
                    v-if="loading"
                    class="spinner-border spinner-border-md"
                    style="width: 1rem; height: 1rem"
                  ></div>
                  <i v-else class="menu-icon tf-icons bx bx-save"></i>Save changes</button>
                          <!-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> -->
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
components: {
    VueEditor
  },
  data(){
    return {
      profile:{
        firstname: '',
        lastname: '',
        number: '',
        address: '',
        country: '',
        shortdescription: '',
        details: '',
        fb_link:'',
        github_link: '',
        image: ''
      },
      avatar: '',
      loading: false
    }
  },
  mounted(){
    this.uploadAndReset();
    this.getprofile();
  },
  methods:{
    saveProfile(){
      let form = new FormData;
      form.append('firstname',this.profile.firstname);
        form.append('lastname', this.profile.lastname);
        form.append('number', this.profile.number);
        form.append('address', this.profile.address);
        form.append('country', this.profile.country);
        form.append('shortdescription', this.profile.shortdescription);
        form.append('details', this.profile.details);
        form.append('fb_link', this.profile.fb_link);
        form.append('github_link', this.profile.github_link);
        form.append('image' ,this.avatar);
      this.loading = !false;
     setTimeout(()=> {
        axios.post('/saveuserinfo', form)
      .then((res) => {
          Toast.fire({
            icon: "success",
            title: "Information successfully saved!",
          });
          this.loading = !true 
      })
      .catch((err) => {
         Toast.fire({
            icon: "error",
            title: "Opps! something went wrong",
          });
      });
     },2000);
    },
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
    },
    uploadAndReset(){
      // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input');


    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = (e) => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
          this.avatar = fileInput.files[0];
        }
      };
    }
    }
  }
}
</script>

<style>

</style>